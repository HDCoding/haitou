<?php

namespace App\Models;

use App\Helpers\BBCode;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'studios';

    protected $casts = [
        'views' => 'int'
    ];

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'website',
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

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
