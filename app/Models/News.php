<?php

namespace App\Models;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'news';

    protected $casts = [
        'user_id' => 'int',
        'views' => 'int',
        'is_published' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'views',
        'is_published'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
