<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	protected $table = 'ratings';

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'media_id' => 'int',
		'torrent_id' => 'int',
		'vote' => 'int'
	];

	protected $fillable = [
		'user_id',
		'media_id',
		'torrent_id',
		'vote'
	];

	public function media()
	{
		return $this->belongsTo(Media::class);
	}

	public function torrent()
	{
		return $this->belongsTo(Torrent::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
