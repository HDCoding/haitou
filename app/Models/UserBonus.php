<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBonus extends Model
{
    use SoftDeletes;
    protected $table = 'user_bonus';

    protected $casts = [
        'bonus_id' => 'int',
        'user_id' => 'int',
        'member_id' => 'int',
        'cost' => 'int'
    ];

    protected $fillable = [
        'bonus_id',
        'user_id',
        'member_id',
        'cost',
        'description'
    ];

    public function bonus()
    {
        return $this->belongsTo(Bonus::class, 'bonus_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
