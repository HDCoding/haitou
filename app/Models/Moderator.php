<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'moderators';
    protected $casts = [
        'forum_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'forum_id',
        'user_id'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
