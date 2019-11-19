<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freeleech extends Model
{
    use SoftDeletes;
    protected $table = 'freeleeches';

    protected $casts = [
        'torrent_id' => 'int',
        'user_id' => 'int',
        'is_freeleech' => 'bool',
        'is_silver' => 'bool',
        'is_doubleup' => 'bool',
        'is_active' => 'bool'
    ];

    protected $dates = [
        'expires_on'
    ];

    protected $fillable = [
        'torrent_id',
        'user_id',
        'is_freeleech',
        'is_silver',
        'is_doubleup',
        'is_active',
        'expires_on'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
