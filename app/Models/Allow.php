<?php

namespace App\Models;

use App\User;
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

    public function user()
    {
        return $this->hasMany(UserAllow::class);
    }

}
