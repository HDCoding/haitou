<?php

namespace App\Notifications;

use App\Models\Thank;
use App\Models\Torrent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewThankYouNotification extends Notification
{
    use Queueable;

    public $torrent;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param Thank $thank
     */
    public function __construct(Torrent $torrent)
    {
        $this->torrent = $torrent;
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
            'title' => 'Agradeceu pelo Torrent enviado',
            'icon' => '',
            'body' => ' Deixou um agradecimento em Uploaded Torrent ' . $this->torrent->name,
            'url' => "{$appurl}/torrent/{$this->torrent->id}.{$this->torrent->torrent->slug}",
        ];
    }
}
