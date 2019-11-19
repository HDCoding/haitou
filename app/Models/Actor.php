<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'actors';

    protected $casts = [
        'views' => 'int'
    ];

    protected $dates = [
        'birthday'
    ];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'website',
        'description',
        'birthday',
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
