<?php

namespace App\Models;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'groups';

    protected $casts = [
        'hnr' => 'int'
    ];

    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon',
        'hnr'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissionsByForum($forum)
    {
        return $this->permissions()->where('forum_id', '=', $forum->id)
            ->where('group_id', '=', $this->id)
            ->first();
    }

    /**
     * Forum permissions
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
