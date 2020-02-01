<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    protected $table = 'states';

    protected $fillable = [
        'name',
        'uf',
        'flag'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function flag()
    {
        return asset('images/states/' . $this->flag);
    }
}
