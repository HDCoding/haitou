<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fansub extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'fansubs';

    protected $casts = [
        'views' => 'int',
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'website',
        'discord',
        'description',
        'views',
        'is_active'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'users');
    }

    public function users()
    {
        return $this->hasMany(FansubUser::class);
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function status()
    {
        return $this->is_active ? '<strong class="text-success text-big">Ativo</strong>' : '<strong class="text-danger text-big">Inativo</strong>';
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }

    public function fansub_mod($fansub_id)
    {
        $members = FansubUser::all()->where('fansub_id', '=', $fansub_id);
        foreach ($members as $member) {
            if ($member->user_id == auth()->user()->id AND $member->is_admin == true) {
                return true;
            }
        }
        return false;
    }
}
