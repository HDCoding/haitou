<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $table = 'forums';

    protected $casts = [
        'category_id' => 'int',
        'last_topic_id' => 'int',
        'last_post_user_id' => 'int',
        'position' => 'int',
        'num_topic' => 'int',
        'num_post' => 'int',
        'views' => 'int'
    ];

    protected $fillable = [
        'category_id',
        'last_topic_id',
        'last_post_user_id',
        'position',
        'name',
        'slug',
        'description',
        'icon',
        'num_topic',
        'num_post',
        'views',
        'last_topic_name',
        'last_topic_slug',
        'last_post_username'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function moderators()
    {
        return $this->belongsToMany(Moderator::class, 'moderators', 'forum_id', 'user_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function subscription_topics()
    {
        if (auth()->user()) {
            $id = $this->id;
            $subscriptions = auth()->user()->subscriptions->where('topic_id', '>', 0)->pluck('topic_id')->toArray();
            return $this->hasMany(Topic::class)->where(function ($query) use ($id, $subscriptions) {
                $query->whereIn('topics.id', [$id])->orWhereIn('topics.id', [$subscriptions]);
            });
        }
        return $this->hasMany(Topic::class, 'id', 'topic_id');
    }

    public function getPermission()
    {
        if (auth()->check()) {
            $group = auth()->user()->group;
        }

        return $group->permissions->where('forum_id', $this->id)->first();
    }

    /**
     * Count The Number Of Posts In The Forum
     * @param $forum_id
     * @return int
     */
    public function postCount($forum_id)
    {
        $forum = self::find($forum_id);
        $topics = $forum->topics;
        $count = 0;
        foreach ($topics as $t) {
            $count += $t->posts()->count();
        }
        return $count;
    }

    /**
     * Count The Number Of Topics In The Forum
     * @param $forum_id
     * @return int
     */
    public function topicCount($forum_id)
    {
        $forum = self::find($forum_id);

        return Topic::where('forum_id', '=', $forum->id)->count();
    }
}
