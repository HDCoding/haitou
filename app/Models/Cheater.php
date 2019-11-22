<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cheater extends Model
{
    protected $table = 'cheaters';

    protected $casts = [
        'user_id' => 'int',
        'port' => 'int',
        'is_blacklist' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'port',
        'ip',
        'program',
        'is_blacklist'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
