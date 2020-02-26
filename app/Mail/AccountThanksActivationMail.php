<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountThanksActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $siteName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->siteName = setting('site_title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Agradeçemos por ativar sua conta!')
            ->markdown('emails.thanks_activation')
            ->with(['site_name' => $this->siteName]);
    }
}
