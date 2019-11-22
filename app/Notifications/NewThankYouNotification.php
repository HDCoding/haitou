<?php

namespace App\Notifications;

use App\Models\Thank;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewThankYouNotification extends Notification
{
    use Queueable;

    public $type;

    public $thank;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param Thank $thank
     */
    public function __construct(string $type, Thank $thank)
    {
        $this->type = $type;
        $this->thank = $thank;
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
        $appurl = config('app.url');

        return [
            'title' => $this->thank->user->username . ' Agradeceu por um Torrent enviado',
            'icon' => '',
            'body' => $this->thank->user->username . ' deixou um agradecimento em Uploaded Torrent ' . $this->thank->torrent->name,
            'url' => "{$appurl}/torrent/{$this->thank->torrent->id}.{$this->thank->torrent->slug}",
        ];
    }
}
