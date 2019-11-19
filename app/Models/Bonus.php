<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use SoftDeletes;
    protected $table = 'bonus';

    protected $casts = [
        'cost' => 'int',
        'quantity' => 'int',
        'bonus_type' => 'int',
        'bytes' => 'int',
        'is_enabled' => 'bool'
    ];

    protected $fillable = [
        'name',
        'description',
        'cost',
        'quantity',
        'bonus_type',
        'bytes',
        'is_enabled'
    ];
}
