<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountEmailUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public $site_name;

    /**
     * Create a new message instance.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
        $this->site_name = setting('site_title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Atualize sua conta!')
            ->markdown('emails.email_activation')
            ->with(['site_name' => $this->site_name, 'code' => $this->code]);
    }
}
