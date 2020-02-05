<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $site_name;

    /**
     * Create a new message instance.
     *
     * @param string $code
     */
    public function __construct(User $user, string $code)
    {
        $this->user = $user;
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
        return $this->subject('Ative sua conta!')
            ->markdown('emails.account_activation')
            ->with(['site_name' => $this->site_name, 'code' => $this->code]);
    }
}
