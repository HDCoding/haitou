<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'characters';

    protected $casts = [
        'views' => 'int'
    ];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'views'
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
