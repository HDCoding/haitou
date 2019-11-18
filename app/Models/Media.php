<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
	use SoftDeletes;
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
}
