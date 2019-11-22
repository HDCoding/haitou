<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;
    protected $table = 'likes';
    protected $casts = [
        'user_id' => 'int',
        'torrent_id' => 'int',
        'post_id' => 'int',
        'is_like' => 'bool',
        'is_dislike' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'torrent_id',
        'post_id',
        'is_like',
        'is_dislike'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function torrent()
    {
        return $this->belongsTo(Torrent::class, 'torrent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
