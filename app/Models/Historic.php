<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $table = 'historics';

    protected $casts = [
        'torrent_id' => 'int',
        'user_id' => 'int',
        'uploaded' => 'int',
        'mod_uploaded' => 'int',
        'real_uploaded' => 'int',
        'downloaded' => 'int',
        'mod_downloaded' => 'int',
        'real_downloaded' => 'int',
        'is_seeder' => 'bool',
        'is_leecher' => 'bool',
        'is_active' => 'bool',
        'is_released' => 'bool',
        'seed_time' => 'int'
    ];

    protected $dates = [
        'completed_at'
    ];

    protected $fillable = [
        'torrent_id',
        'user_id',
        'passkey',
        'client',
        'uploaded',
        'mod_uploaded',
        'real_uploaded',
        'downloaded',
        'mod_downloaded',
        'real_downloaded',
        'is_seeder',
        'is_leecher',
        'is_active',
        'is_released',
        'seed_time',
        'completed_at'
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
