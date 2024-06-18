<?php
declare(strict_types= 1);

namespace Src\Modules\Companies\Application;

use App\Events\Agents\AgentHasBeenSelected;
use App\Models\Agent;
use App\Models\Company;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Modules\Agents\Application\AgentResolver;

final class Updater implements \JsonSerializable {

    private $response;

    public function __construct(private AgentResolver $agentResolver) {}

    public function __invoke(Company $company, bool $assignThemselves): void
    {
        $state = $company->state;

        try {
            DB::beginTransaction();

            $agent = $assignThemselves || !$state->active
                ? null
                : $this->agentResolver->__invoke(
                    state: $state,
                    except: $company->agent ? [$company->agent->id] : []
                )
            ;

            $type  = $agent ? 1 : 2;

            // TODO: Emit event AgentHasBeenUpdated
            $company->update([
                'registered_agent_id'   => $agent->id ?? null,
                'registered_agent_type' => $type
            ]);

            $this->response = [
                'assignThemselves' => $assignThemselves,
                'assigned'         => $agent ?? auth()->user()
            ];

            if ($agent) {
                event(new AgentHasBeenSelected($agent, $company));
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage(), $th->getTrace());
        }
    }

    public function jsonSerialize() {
        return $this->response;
    }
}