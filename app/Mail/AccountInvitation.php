<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountInvitation extends Mailable
{
    use Queueable, SerializesModels;

    protected $invite, $siteName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invite)
    {
        $this->invite = $invite;
        $this->siteName = setting('site_title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Convite especial ao nosso site!')
            ->markdown('emails.account_invitation')
            ->with([
                'username' => $this->invite->user->username,
                'siteName' => $this->siteName,
                'code' => $this->invite->code,
                'expire' => $this->invite->expires_on->format('d/m/Y H:i')
            ]);
    }
}
