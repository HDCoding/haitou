<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{
    use SoftDeletes;
    protected $table = 'rules';

    protected $fillable = [
        'name',
        'description',
        'color',
        'icon',
        'groups'
    ];
}
