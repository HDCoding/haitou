<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $casts = [
        'user_id' => 'int',
        'actor_id' => 'int',
        'calendar_id' => 'int',
        'character_id' => 'int',
        'fansub_id' => 'int',
        'media_id' => 'int',
        'studio_id' => 'int',
        'torrent_id' => 'int',
        'is_spoiler' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'actor_id',
        'calendar_id',
        'character_id',
        'fansub_id',
        'media_id',
        'studio_id',
        'torrent_id',
        'content',
        'is_spoiler'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actor_id');
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'character_id');
    }

    public function fansub()
    {
        return $this->belongsTo(Fansub::class, 'fansub_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function torrent()
    {
        return $this->belongsTo(Torrent::class, 'torrent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contentHtml()
    {
        return (new BBCode())->parse($this->content, true);
    }
}
