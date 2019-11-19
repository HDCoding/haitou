<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    protected $table = 'vips';

    protected $casts = [
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
