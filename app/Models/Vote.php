<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $casts = [
        'poll_id' => 'int',
        'option_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'poll_id',
        'option_id',
        'user_id'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
