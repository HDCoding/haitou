<?php

namespace App\Models;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use Sluggable;

    protected $table = 'polls';

    protected $casts = [
        'user_id' => 'int',
        'topic_id' => 'int',
        'multi_choice' => 'bool',
        'is_main' => 'bool',
        'is_closed' => 'bool'
    ];

    protected $dates = [
        'closed_at'
    ];

    protected $fillable = [
        'user_id',
        'topic_id',
        'name',
        'slug',
        'description',
        'multi_choice',
        'is_main',
        'is_closed',
        'closed_at'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

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
