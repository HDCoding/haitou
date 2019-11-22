<?php

namespace App\Models;

use App\Helpers\BBCode;
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
