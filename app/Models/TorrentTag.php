<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TorrentTag extends Model
{
    public $timestamps = false;
    protected $table = 'torrent_tags';
    protected $casts = [
        'torrent_id' => 'int',
        'tag_id' => 'int'
    ];

    protected $fillable = [
        'torrent_id',
        'tag_id'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }
}
