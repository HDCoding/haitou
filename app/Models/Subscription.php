<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $timestamps = false;

    protected $table = 'subscriptions';

    protected $casts = [
        'forum_id' => 'int',
        'topic_id' => 'int',
        'user_id' => 'int',
        'email' => 'bool',
        'notify' => 'bool'
    ];

    protected $fillable = [
        'forum_id',
        'topic_id',
        'user_id',
        'email',
        'notify'
    ];

    public function forum()
    {
        return $this->belongsToMany(Forum::class, 'forums', 'forum_id');
    }

    public function topic()
    {
        return $this->belongsToMany(Topic::class, 'topics', 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
