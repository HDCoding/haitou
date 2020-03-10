<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use Sluggable;

    protected $table = 'polls';

    protected $casts = [
        'user_id' => 'int',
        'multi_choice' => 'bool',
        'is_main' => 'bool',
        'is_closed' => 'bool',
        'views' => 'int'
    ];

    protected $dates = [
        'closed_at'
    ];

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'multi_choice',
        'is_main',
        'is_closed',
        'views',
        'closed_at',
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

    public function totalVotes()
    {
        return $this->votes()->count();
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Option::class, 'poll_id', 'option_id', 'id', 'id');
    }

    public function hasVoted($userId)
    {
        return $this->votes()->where('user_id', '=', $userId)->count() > 0;
    }

    public function optionsCount()
    {
        return $this->options()->count();
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
