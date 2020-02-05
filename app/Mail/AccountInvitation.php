<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $site_name;

    /**
     * @var Invitation
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param Invitation $invitation
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
        $this->site_name = setting('site_title');
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
                'username' => $this->invitation->user->username,
                'site_name' => $this->site_name,
                'code' => $this->invitation->code,
                'expire' => $this->invitation->expires_on->format('d/m/Y')
            ]);
    }
}
