<?php
declare(strict_types= 1);
namespace Src\Modules\Agents\Application;

use App\Models\Agent;
use App\Models\Company;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Src\Modules\Shared\Balancer;

final class AgentResolver
{
    const TYPE_AGENT = 1;

    public function __construct(private Balancer $balancer) {}

    public function __invoke(State $state): Agent
    {
        $agentTable = (new Agent)->getTable();
        $companyTable = (new Company)->getTable();

        $agents = DB::table($agentTable, 'a')->where('a.state_id', $state->id)
        ->leftJoin($companyTable . ' as c', function($join) use ($state) {
            $join->on('a.id', '=', 'c.registered_agent_id')
                ->where('c.state_id', '=', $state->id)
                ->where('c.registered_agent_type', '=', self::TYPE_AGENT);
        })
        ->select('a.id as entity', DB::raw('COUNT(c.id) as count'))
        ->groupBy('a.id')->get()
        ->map(fn($row) => (array) $row)
        ->toArray();


        if (count($agents) === 1) {
            $agentSelected = Agent::find($agents[0]['entity']);
        } elseif(count($agents) > 1) {
            $selected = $this->balancer->__invoke($agents);
            $agentSelected = Agent::find($selected);
        }

        return $agentSelected;
    }

}
