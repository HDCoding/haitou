<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $table = 'permissions';

    protected $casts = [
        'forum_id' => 'int',
        'group_id' => 'int',
        'view_forum' => 'bool',
        'read_topic' => 'bool',
        'reply_topic' => 'bool',
        'start_topic' => 'bool'
    ];

    protected $fillable = [
        'forum_id',
        'group_id',
        'view_forum',
        'read_topic',
        'reply_topic',
        'start_topic'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
