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

    public function user()
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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
