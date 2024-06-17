<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\State;
use Src\Modules\Agents\Application\CapacityChecker;

class StateController extends Controller
{
    public function checkCapacity(State $state, CapacityChecker $checker)
    {
        $checker->__invoke($state);

        return $this->success(data: $checker);
    }
}
