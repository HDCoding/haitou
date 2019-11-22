<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;
    use Sluggable;

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
        return $this->belongsToMany(Moderator::class, 'moderators', 'forum_id', 'staff_id');
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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getPermission()
    {
        if (auth()->check()) {
            $group = auth()->user()->group;
        }
        return $group->permissions->where('forum_id', '=', $this->id)->first();
    }
}
