<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPostTagNotification extends Notification
{
    use Queueable;

    public $type;

    public $tagger;

    public $post;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param string $tagger
     * @param Post $post
     */
    public function __construct(string $type, string $tagger, Post $post)
    {
        $this->type = $type;
        $this->tagger = $tagger;
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

        return [
            'title' => $this->tagger . ' Marcou você em uma postagem',
            'icon' => '',
            'body' => $this->tagger . ' marcou você em uma postagem no tópico ' . $this->post->topic->name,
            'url' => "{$appurl}/forum/topic/{$this->post->topic->id}.{$this->post->topic->slug}?page={$this->post->pageNumber()}#post-{$this->post->id}"
        ];
    }
}
