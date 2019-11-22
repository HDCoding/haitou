<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false;
    protected $table = 'ratings';
    protected $casts = [
        'user_id' => 'int',
        'media_id' => 'int',
        'torrent_id' => 'int',
        'vote' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'media_id',
        'torrent_id',
        'vote'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
