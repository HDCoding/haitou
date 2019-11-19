<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $casts = [
        'user_id' => 'int',
        'is_mobile' => 'bool',
        'is_tablet' => 'bool',
        'is_desktop' => 'bool',
        'is_staff' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'content',
        'ip',
        'user_agent',
        'system',
        'is_mobile',
        'is_tablet',
        'is_desktop',
        'is_staff'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
