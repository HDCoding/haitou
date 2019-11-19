<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
    protected $table = 'completes';

    protected $casts = [
        'torrent_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'torrent_id',
        'user_id'
    ];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
