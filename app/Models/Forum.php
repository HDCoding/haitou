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
        'position' => 'int',
        'views' => 'int'
    ];

    protected $fillable = [
        'category_id',
        'position',
        'name',
        'slug',
        'description',
        'icon',
        'views'
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
        return $this->hasMany(Moderator::class);
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
                $query->whereIn('topics.id', [$id])->orWhereIn('topics.id', $subscriptions);
            });
        }
        return $this->hasMany(Topic::class, 'id', 'topic_id');
    }

    public function getPermission()
    {
        if (auth()->check()) {
            $group = auth()->user()->group;
        }
        return $group->permissions->where('forum_id', '=', $this->id)->first();
    }
}
