<?php

namespace App\Notifications;

use App\Models\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification
{
    use Queueable;

    public $post;

    public $type;

    public $poster;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param User $poster
     * @param Post $post
     */
    public function __construct(string $type, User $poster, Post $post)
    {
        $this->type = $type;
        $this->poster = $poster;
        $this->post = $post;
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

        if ($this->type == 'subscription') {
            return [
                'title' => $this->poster->name . ' Postou em um Subscrito Tópico',
                'icon' => '',
                'body' => $this->poster->name . ' deixou uma nova postagem no Tópico inscrito ' . $this->post->topic->name,
                'url' => "{$appurl}/forum/topic/{$this->post->topic->id}.{$this->post->topic->slug}?page={$this->post->getPageNumber()}#post-{$this->post->id}"
            ];
        } else {
            return [
                'title' => $this->poster->name . ' Postou em um tópico que você iniciou',
                'icon' => '',
                'body' => $this->poster->name . ' deixou uma nova postagem em seu tópico ' . $this->post->topic->name,
                'url' => "{$appurl}/forum/topic/{$this->post->topic->id}.{$this->post->topic->slug}?page={$this->post->getPageNumber()}#post-{$this->post->id}"
            ];
        }
    }
}
