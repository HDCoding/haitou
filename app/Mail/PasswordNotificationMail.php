<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $site_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->site_name = setting('site_title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Sua senha foi alterada!')
            ->markdown('emails.password_notification')
            ->with(['site_name' => $this->site_name]);
    }
}
