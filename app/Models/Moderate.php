<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Moderate extends Model
{
    protected $table = 'moderates';

    protected $casts = [
        'user_id' => 'int',
        'staff_id' => 'int',
        'is_enabled' => 'bool',
        'is_banned' => 'bool',
        'is_suspended' => 'bool',
        'is_warned' => 'bool'
    ];

    protected $dates = [
        'expires_on'
    ];

    protected $fillable = [
        'user_id',
        'staff_id',
        'title',
        'description',
        'is_enabled',
        'is_banned',
        'is_suspended',
        'is_warned',
        'expires_on'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
