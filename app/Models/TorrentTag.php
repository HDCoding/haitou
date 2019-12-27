<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TorrentTag extends Model
{
	protected $table = 'torrent_tags';

	public $incrementing = false;

	public $timestamps = false;

	protected $casts = [
		'torrent_id' => 'int',
		'tag_id' => 'int'
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
