<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Allow extends Model
{
    use Sluggable;

	protected $table = 'allows';

	protected $casts = [
        'is_staff' => 'bool'
    ];

	protected $fillable = [
		'name',
		'slug',
        'is_staff'
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
