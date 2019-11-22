<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public $timestamps = false;
    protected $table = 'bookmarks';
    protected $casts = [
        'user_id' => 'int',
        'character_id' => 'int',
        'actor_id' => 'int',
        'media_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'character_id',
        'actor_id',
        'media_id'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actor_id');
    }

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
