<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountEmailUpdate extends Mailable
{
    use Queueable, SerializesModels;

    protected $code, $siteName, $setting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        $this->code = $code;
        $this->siteName = setting('site_title');
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
            ->with(['siteName' => $this->siteName, 'code' => $this->code]);
    }
}
