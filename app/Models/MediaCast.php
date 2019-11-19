<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaCast extends Model
{
    public $timestamps = false;
    protected $table = 'media_casts';
    protected $casts = [
        'media_id' => 'int',
        'character_id' => 'int',
        'actor_id' => 'int'
    ];

    protected $fillable = [
        'media_id',
        'character_id',
        'actor_id'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
