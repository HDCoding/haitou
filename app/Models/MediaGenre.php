<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaGenre extends Model
{
	protected $table = 'media_genres';

	public $timestamps = false;

	protected $casts = [
		'media_id' => 'int',
		'genre_id' => 'int'
	];

	protected $fillable = [
		'media_id',
		'genre_id'
	];

	public function genre()
	{
		return $this->belongsTo(Genre::class);
	}

	public function media()
	{
		return $this->belongsTo(Media::class);
	}
}
