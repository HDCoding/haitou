<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';

    protected $casts = [
        'forum_id' => 'int',
        'topic_id' => 'int',
        'post_id' => 'int',
        'user_id' => 'int',
        'size' => 'int',
        'downs' => 'int'
    ];

    protected $fillable = [
        'forum_id',
        'topic_id',
        'post_id',
        'user_id',
        'md5_hash',
        'sha1_hash',
        'filename',
        'mimetype',
        'extension',
        'size',
        'downs'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
