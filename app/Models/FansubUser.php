<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FansubUser extends Model
{
    protected $table = 'fansub_users';

    protected $casts = [
        'fansub_id' => 'int',
        'user_id' => 'int',
        'is_admin' => 'bool'
    ];

    protected $fillable = [
        'fansub_id',
        'user_id',
        'username',
        'job',
        'is_admin'
    ];

    public function fansub()
    {
        return $this->belongsTo(Fansub::class, 'fansub_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
