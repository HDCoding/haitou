<?php

namespace App\Models;

use App\Helpers\BBCode;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table = 'medias';

    protected $casts = [
        'category_id' => 'int',
        'studio_id' => 'int',
        'media_type' => 'int',
        'is_adult' => 'bool',
        'status' => 'int',
        'views' => 'int',
        'total_episodes' => 'int',
        'duration' => 'int',
        'total_chapters' => 'int',
        'total_volumes' => 'int'
    ];

    protected $dates = [
        'released_at',
        'finished_at'
    ];

    protected $fillable = [
        'category_id',
        'studio_id',
        'name',
        'slug',
        'title_english',
        'title_japanese',
        'media_type',
        'released_at',
        'finished_at',
        'description',
        'is_adult',
        'cover',
        'poster',
        'status',
        'yt_video',
        'views',
        'total_episodes',
        'duration',
        'total_chapters',
        'total_volumes'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function media_casts()
    {
        return $this->hasMany(MediaCast::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'media_genres')->withPivot('id');
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

    public function poster()
    {
        return empty($this->poster) ? asset('images/no-poster.png') : asset('storage/medias/' . $this->poster);
    }

    public function cover()
    {
        return empty($this->cover) ? asset('images/no-cover.jpg') : asset('storage/medias/' . $this->cover);
    }

    public function genre()
    {
        $type = $this->media_type;

        if ($type == 0) {
            return '<span class="label label-success">Anime</span>';
        } elseif ($type == 1) {
            return '<span class="label label-danger">Manga</span>';
        } elseif ($type == 2) {
            return '<span class="label label-warning">Dorama</span>';
        }
    }

    public function status()
    {
        $status = $this->status;

        if ($status == 1) {
            return '<span class="label label-success">Finalizado</span>';
        } elseif ($status == 2) {
            return '<span class="label label-warning">Exibindo</span>';
        } elseif ($status == 3) {
            return '<span class="label label-danger">Cancelado</span>';
        }
    }

    public function trailer()
    {
        $url = $this->yt_video;

        if (!empty($url)) {
            if ($this->checkUrl($url)) {
                $fetch = explode("v=", $url);
                return "https://www.youtube-nocookie.com/embed/{$fetch[1]}?rel=0&amp;showinfo=0";
            }
        }
        return 'Erro';
    }

    /**
     * check if the URL passed in the YouTube Video are valid
     *
     * @param $url
     * @return bool
     */
    protected function checkUrl($url)
    {
        // Remove all illegal characters from a url
        $url = filter_var($url, FILTER_SANITIZE_URL);
        // Validate URI
        // And check only for http/https schemes.
        if (filter_var($url, FILTER_VALIDATE_URL) === false || !in_array(strtolower(parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) {
            return false;
        }
        // Check that URL exists
        $file_headers = get_headers($url);
        return !$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found' ? false : true;
    }

    public function avgRating()
    {
        return number_format($this->ratings()->avg('vote'), 1, '.', ',');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function totalRating()
    {
        return $this->ratings()->count('vote');
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
