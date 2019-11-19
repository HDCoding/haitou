<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LotteryWinner extends Model
{
    protected $table = 'lottery_winners';

    protected $casts = [
        'lottery_id' => 'int',
        'user_id' => 'int',
        'total_num_found' => 'int'
    ];

    protected $fillable = [
        'lottery_id',
        'user_id',
        'numbers',
        'total_num_found'
    ];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
