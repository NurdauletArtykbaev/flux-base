<?php

namespace Nurdaulet\FluxBase\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportSendMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(private  $support)
    {
    }

    public function build()
    {
        return $this->view('mail.support')
                ->with([
                    'support' => $this->support,
                    'user' => $this->support->user,
                ]);
    }
}
