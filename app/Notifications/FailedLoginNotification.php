<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FailedLoginNotification extends Notification
{
    use Queueable;

    /*
     * The request IP Adress
     */
    public $ip;

    /*
     * The Time
     */
    public $time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ip = request()->ip();
        $this->time = now();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->error()
            ->subject('Notificação de início de sessão falhada')
            ->greeting('Falha no login da conta!')
            ->line('Um login com falha foi detectado para sua conta.')
            ->line(str_replace([':ip', ':host', ':time'], [$this->ip, gethostbyaddr($this->ip), $this->time], 'Esta solicitação foi originada de :ip (:host) em :time'));
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
            'ip' => $this->ip,
            'time' => $this->time
        ];
    }
}
