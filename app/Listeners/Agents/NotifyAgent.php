<?php

namespace App\Listeners\Agents;

use App\Events\Agents\AgentHasBeenSelected;
use App\Jobs\Agents\NotifyAgentSelectedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAgent
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
        NotifyAgentSelectedEmail::dispatch(
            $event->agent,
            $event->company
        )->onQueue('redis');
    }
}
