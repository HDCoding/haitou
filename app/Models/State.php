<?php

namespace App\Models;

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

    public function flag()
    {
        return asset('images/states/' . $this->flag);
    }
}
