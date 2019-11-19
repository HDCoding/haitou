<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    protected $table = 'moderators';

    protected $casts = [
        'forum_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'forum_id',
        'user_id',
        'username'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
