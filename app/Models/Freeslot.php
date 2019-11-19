<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freeslot extends Model
{
    use SoftDeletes;
    protected $table = 'freeslots';

    protected $casts = [
        'required' => 'int',
        'actual' => 'int',
        'days' => 'int',
        'is_freeleech' => 'bool',
        'is_silver' => 'bool',
        'is_doubleup' => 'bool'
    ];

    protected $fillable = [
        'name',
        'slug',
        'required',
        'actual',
        'days',
        'is_freeleech',
        'is_silver',
        'is_doubleup'
    ];
}
