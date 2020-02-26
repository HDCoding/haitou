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

    public $user;

    /**
     * Create a new notification instance.
     *
     * @param string $type
     * @param User $user
     * @param Post $post
     */
    public function __construct(string $type, User $user, Post $post)
    {
        $this->type = $type;
        $this->user = $user;
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
        $url = "{$appurl}/forum/topic/{$this->post->topic->id}.{$this->post->topic->slug}?page={$this->post->pageNumber()}#post-{$this->post->id}";

        if ($this->type == 'subscription') {
            return [
                'title' => $this->user->username . ' Postou em um Tópico que você se inscreveu',
                'icon' => '',
                'body' => $this->user->username . ' deixou uma nova postagem no Tópico inscrito ' . $this->post->topic->name,
                'url' => $url
            ];
        } elseif ($this->type == 'reply') {
            return [
                'title' => $this->user->username . ' Respondeu sua Postagem',
                'icon' => '',
                'body' => $this->user->username . ' Deu Reply na sua postagem ' . $this->post->topic->name,
                'url' => $url
            ];
        } else {
            return [
                'title' => $this->user->username . ' Postou em um tópico que você iniciou',
                'icon' => '',
                'body' => $this->user->username . ' deixou uma nova postagem em seu tópico ' . $this->post->topic->name,
                'url' => $url
            ];
        }
    }
}
