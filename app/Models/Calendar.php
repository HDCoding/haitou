<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'calendars';

    protected $casts = [
        'user_id' => 'int',
        'is_enabled' => 'bool',
        'views' => 'int'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'color',
        'is_enabled',
        'views',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'calendar_id');
    }

    public function thanks()
    {
        return $this->hasMany(Thank::class, 'calendar_id');
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
