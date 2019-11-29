<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'searches';

    protected $casts = [
        'user_id' => 'int',
        'results' => 'int',
        'hits' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'username',
        'term',
        'results',
        'hits'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
