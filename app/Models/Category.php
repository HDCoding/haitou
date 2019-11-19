<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'categories';

    protected $casts = [
        'is_faq' => 'bool',
        'is_forum' => 'bool',
        'is_media' => 'bool',
        'is_torrent' => 'bool',
        'position' => 'int',
        'views' => 'int'
    ];

    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon',
        'is_faq',
        'is_forum',
        'is_media',
        'is_torrent',
        'position',
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
