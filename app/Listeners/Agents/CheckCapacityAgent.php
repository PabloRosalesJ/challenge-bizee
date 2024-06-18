<?php

namespace App\Listeners\Agents;

use App\Events\Agents\AgentHasBeenSelected;
use App\Jobs\Agents\NotifyTheLimitWasExceededEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CheckCapacityAgent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AgentHasBeenSelected $event): void
    {

        if ($event->agent->theLimitWasExceeded()) {
            NotifyTheLimitWasExceededEmail::dispatch(
                $event->agent
            )->onQueue('redis');
        }
    }
}