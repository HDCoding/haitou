<?php

namespace App\Notifications;

use App\Models\Torrent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReseedRequestNotification extends Notification
{
    use Queueable;

    public $torrent;

    /**
     * Create a new notification instance.
     *
     * @param Torrent $torrent
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
            'title' => 'Nova Solicitação de Reseed',
            'icon' => 'ion ion-logo-buffer bg-secondary',
            'body' => "Há algum tempo, você baixou: {$this->torrent->name}. Agora está morto e alguém solicitou uma nova propagação. Se você ainda tiver esse torrent em armazenamento, considere realimentá-lo novamente!",
            'url' => "{$appurl}/torrent/{$this->torrent->id}.{$this->torrent->slug}",
        ];
    }
}
