<?php
declare(strict_types=1);
namespace Src\Modules\Agents\Application;

use App\Models\Agent;
use App\Models\Company;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CapacityChecker implements \JsonSerializable
{
    private $response;

    public function __invoke(State $state)
    {
        abort_if(!$state->active, 400, 'The selected state currently doesn\'t have capacity');

        $companyTable = (new Company)->getTable();
        $agentTable   = (new Agent)->getTable() . ' as a';

        try {
            DB::beginTransaction();

            $state->loadSum('agents', 'capacity')
            ->loadCount(['companies' => fn(Builder $q)  =>
                $q->join(
                    $agentTable,
                    fn(JoinClause $join) => $join
                        ->on('a.id', '=', "$companyTable.registered_agent_id")
                        ->where('a.state_id', $state->id)
                        ->whereNull('a.deleted_at')
                )
            ])->lockForUpdate();

            $this->response = [
                'name'=> $state->name,
                'code'=> $state->code,
                'hasCapacity'=> $state['companies_count'] < $state['agents_sum_capacity'],
                // 'state'=> $state,
            ];
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['err' => $th->getTraceAsString()]);
        } finally {
            DB::commit();
        }

    }

    public function jsonSerialize() {
        return $this->response;
    }
}
