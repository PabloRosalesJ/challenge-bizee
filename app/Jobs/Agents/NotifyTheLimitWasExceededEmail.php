<?php

namespace App\Jobs\Agents;

use App\Models\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyTheLimitWasExceededEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Agent $agent) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $agent = $this->agent;
        $limit = env('LIMIT_OF_COMPANIES_ASSIGNED_TO_AN_AGENT');
        Mail::raw(
            "Hi!. The agent {$agent->name} - {$agent->email} was exceeded the {$limit}% of capacity",
            fn (Message $message) => $message
                ->subject('Agents - Limit exceeded')
                ->to(env('ADMIN_EMAIL'))
                ->from(env('MAIL_FROM_ADDRESS'))
        );
    }

    /**
     * Handle a job failure.
     */
    public function failed(?\Throwable $exception): void
    {
        Log::error(
            __CLASS__ . ' - ' . $exception->getMessage(),
            $exception->getTrace()
        );
    }
}
