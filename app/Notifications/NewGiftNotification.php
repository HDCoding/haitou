<?php

namespace App\Notifications;

use App\Models\UserBonus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewGiftNotification extends Notification
{
    use Queueable;

    public $type;

    public $sender;

    public $transaction;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param string $sender
     * @param UserBonus $transaction
     */
    public function __construct(string $type, string $sender, UserBonus $transaction)
    {
        $this->type = $type;
        $this->sender = $sender;
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return void
     */
    public function toMail($notifiable)
    {
        //
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->sender . ' Te presenteou ' . $this->transaction->cost . ' Bônus',
            'icon' => '',
            'body' => $this->sender . ' Te presenteou ' . $this->transaction->cost . ' Bônus'
        ];
    }
}
