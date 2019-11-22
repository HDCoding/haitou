<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Peer extends Model
{
    protected $table = 'peers';

    protected $casts = [
        'torrent_id' => 'int',
        'user_id' => 'int',
        'is_seeder' => 'bool',
        'is_leecher' => 'bool',
        'port' => 'int',
        'uploaded' => 'int',
        'downloaded' => 'int',
        'remaining' => 'int'
    ];

    protected $fillable = [
        'torrent_id',
        'user_id',
        'md5_peer_id',
        'peer_id',
        'ip',
        'client',
        'passkey',
        'is_seeder',
        'is_leecher',
        'port',
        'uploaded',
        'downloaded',
        'remaining'
    ];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
