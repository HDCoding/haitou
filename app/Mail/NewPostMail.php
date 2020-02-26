<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Setting;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Post
     */
    public $post;

    /**
     * @var Setting|mixed
     */
    public $site_name;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Post $post
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->site_name = setting('site_title');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $appurl = config('app.url');

        return $this->subject('Resposta do tópico: ' . $this->post->topic->name)
            ->markdown('emails.new_topic_post')
            ->with([
                'username' => $this->user->username,
                'link' => "{$appurl}/forum/topic/{$this->post->topic->id}.{$this->post->topic->slug}?page={$this->post->pageNumber()}#post-{$this->post->id}",
                'topic_name' => $this->post->topic->name,
                'site_name' => $this->site_name,
            ]);
    }
}
