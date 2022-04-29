<?php

namespace App\Mail;

use App\Http\Dto\MailDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public MailDto $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MailDto $formData)
    {
        $this->mailData = $formData;
    }


    public function build(): NotifyEmail
    {
        $subject   = $this->mailData->getSubject();
        $startDate = $this->mailData->getStart();
        $endDate   = $this->mailData->getEnd();

        return $this->view('emails.xm-notify')
            ->subject($subject)
            ->with(compact('subject'))
            ->with(compact('startDate'))
            ->with(compact('endDate'));
    }
}
