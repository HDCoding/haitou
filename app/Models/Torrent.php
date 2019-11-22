<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Torrent extends Model
{
    use Sluggable;

    protected $table = 'torrents';

    protected $casts = [
        'user_id' => 'int',
        'category_id' => 'int',
        'media_id' => 'int',
        'fansub_id' => 'int',
        'size' => 'int',
        'num_files' => 'int',
        'views' => 'int',
        'downs' => 'int',
        'times_completed' => 'int',
        'seeders' => 'int',
        'leechers' => 'int',
        'allow_comments' => 'bool',
        'is_anonymous' => 'bool',
        'is_freeleech' => 'bool',
        'is_silver' => 'bool',
        'is_doubleup' => 'bool',
        'vip_first' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'category_id',
        'media_id',
        'fansub_id',
        'info_hash',
        'name',
        'slug',
        'filename',
        'announce',
        'description',
        'size',
        'num_files',
        'views',
        'downs',
        'times_completed',
        'seeders',
        'leechers',
        'allow_comments',
        'is_anonymous',
        'is_freeleech',
        'is_silver',
        'is_doubleup',
        'vip_first'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fansub()
    {
        return $this->belongsTo(Fansub::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'torrent_id');
    }

    public function historics()
    {
        return $this->hasMany(Historic::class, 'torrent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'torrent_id');
    }

    public function peers()
    {
        return $this->hasMany(Peer::class, 'torrent_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'torrent_id');
    }

    public function thanks()
    {
        return $this->hasMany(Thank::class, 'torrent_id');
    }

    public function completes()
    {
        return $this->hasMany(Complete::class, 'torrent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'torrent_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function size()
    {
        return make_size($this->size);
    }

    public function freeleech()
    {
        return $this->is_freeleech ? '<span class="badge badge-warning mr-2"><i class="fas fa-arrow-down"></i> Freeleech</span>' : '';
    }

    public function silver()
    {
        return $this->is_silver ? '<span class="badge badge-default mr-2"><i class="fa fa-minus"></i> Silver</span>' : '';
    }

    public function doubleUp()
    {
        return $this->is_doubleup ? '<span class="badge badge-info mr-2"><i class="fa fa-arrow-up"></i> Double UP</span>' : '';
    }

    public function uploader()
    {
        if ($this->is_anonymous) {
            return 'Anonymous';
        } else {
            return link_to_route('user.profile', $this->user->username, [$this->user->slug]);
        }
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
