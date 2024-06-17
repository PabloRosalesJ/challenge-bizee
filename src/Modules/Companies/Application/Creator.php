<?php
declare(strict_types= 1);

namespace Src\Modules\Companies\Application;

use App\Models\Company;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Modules\Agents\Application\AgentResolver;

final class Creator implements \JsonSerializable {

    private Company $response;

    public function __construct(private AgentResolver $agentResolver) {}

    public function __invoke(int $stateId, string $companyName, bool $assignThemselves): void
    {
        $state = State::find($stateId);

        abort_if(
            !$state->active && !$assignThemselves,
            400,
            'The selected state not have agents.'
        );

        try {
            DB::beginTransaction();

            $agent = $assignThemselves ? null : $this->agentResolver->__invoke($state);
            $type  = $agent ? 1 : 2;

            // TODO: Emit event AgentHasBeenSelected

            $this->response = Company::query()->create([
                'user_id'               => auth()->id(),
                'state_id'              => $state->id,
                'registered_agent_id'   => $agent->id ?? null,
                'name'                  => $companyName,
                'registered_agent_type' => $type
            ]);

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