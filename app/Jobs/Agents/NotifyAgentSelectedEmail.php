<?php

namespace App\Jobs\Agents;

use App\Models\Agent;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyAgentSelectedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Agent $agent, public Company $company) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::raw(
            sprintf('Hi %s. Your are been selected to manage the company %s', $this->agent->name, $this->company->name),
            fn (Message $message) => $message
                ->subject('New company to manage')
                ->to($this->agent->email)
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
