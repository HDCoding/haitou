<?php

namespace App\Models;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'topics';

    protected $casts = [
        'forum_id' => 'int',
        'poll_id' => 'int',
        'first_post_user_id' => 'int',
        'last_post_user_id' => 'int',
        'is_locked' => 'bool',
        'is_pinned' => 'bool',
        'views' => 'int'
    ];

    protected $fillable = [
        'forum_id',
        'poll_id',
        'first_post_user_id',
        'last_post_user_id',
        'first_post_username',
        'last_post_username',
        'name',
        'slug',
        'is_locked',
        'is_pinned',
        'views'
    ];

    public function first_user()
    {
        return $this->belongsTo(User::class, 'first_post_user_id');
    }

    public function last_user()
    {
        return $this->belongsTo(User::class, 'last_post_user_id');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'topic_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'topic_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'topic_id');
    }

    public function polls()
    {
        return $this->hasMany(Poll::class, 'topic_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function postNumberFromId($search_id)
    {
        $count = 0;
        foreach ($this->posts() as $post) {
            $count += 1;
            if ($search_id == $post->id) {
                break;
            }
        }
        return $count;
    }

    public function viewable()
    {
        if (auth()->user()->can('forum-mod')) {
            return true;
        }
        return $this->forum()->getPermission()->read_topic;
    }
}
