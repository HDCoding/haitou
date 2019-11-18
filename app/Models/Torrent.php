<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Torrent extends Model
{
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
		return $this->belongsTo(User::class);
	}
}
