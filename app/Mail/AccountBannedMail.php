<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountBannedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $site_name;

    /**
     * @var string
     */
    public $username;

    /**
     * Create a new message instance.
     *
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
        $this->site_name = setting('site_title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Sua conta foi banida!')
            ->markdown('emails.account_banned')
            ->with(['username' => $this->username, 'site_name' => $this->site_name]);
    }
}
