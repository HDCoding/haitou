<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAllow extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'user_allows';
    protected $casts = [
        'user_id' => 'int',
        'allow_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'allow_id'
    ];

    public function allow()
    {
        return $this->belongsToMany(Allow::class, 'allows');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
