<?php

namespace App\Jobs;

use App\Http\Dto\MailDto;
use App\Mail\NotifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private MailDto $mailDto;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MailDto $mailDto)
    {
        $this->mailDto = $mailDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = strtolower($this->mailDto->getEmail());
        Mail::to($email)->send(new NotifyEmail($this->mailDto));
    }
}
