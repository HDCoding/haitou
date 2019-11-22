<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LotteryUser extends Model
{
    protected $table = 'lottery_users';

    protected $casts = [
        'lottery_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'lottery_id',
        'user_id',
        'numbers'
    ];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
