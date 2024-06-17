<?php
declare(strict_types= 1);
namespace Src\Modules\Shared;

final class Balancer
{
    function __invoke(&$agents): int {

        $entitySelected = -1;

        // Sort agents by current load (lowest to highest)
        usort($agents, function($a, $b) {
            return $a['count'] - $b['count'];
        });

        // Check if the difference between the agent with the lowest load and the agent with the highest load is greater than 2
        $minLoad = $agents[0]['count'];
        $maxLoad = $agents[count($agents) - 1]['count'];

        if ($maxLoad - $minLoad > 2) {
            // If the difference is greater than 2, assign the agent with the lowest load
            $entitySelected = $agents[0]['entity'];
        } else {
            // If the difference is 2 or less, find the first agent with the lowest load
            foreach ($agents as $agent) {
                if ($agent['count'] == $minLoad) {
                    $entitySelected = $agent['entity'];
                }
            }
        }

        return $entitySelected;
    }
}
