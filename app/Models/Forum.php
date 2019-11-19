<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'forums';

    protected $casts = [
        'category_id' => 'int',
        'position' => 'int',
        'views' => 'int'
    ];

    protected $fillable = [
        'category_id',
        'position',
        'name',
        'slug',
        'description',
        'icon',
        'views'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
