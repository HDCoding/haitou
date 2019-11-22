<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = false;
    protected $table = 'files';
    protected $casts = [
        'torrent_id' => 'int',
        'size' => 'int'
    ];

    protected $fillable = [
        'torrent_id',
        'size',
        'name'
    ];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function fileSize()
    {
        return make_size($this->size);
    }
}
