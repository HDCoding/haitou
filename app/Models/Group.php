<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'groups';

    protected $casts = [
        'hnr' => 'int'
    ];

    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon',
        'hnr'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
