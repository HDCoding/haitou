<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	protected $table = 'likes';

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'torrent_id' => 'int',
		'post_id' => 'int',
		'is_like' => 'bool',
		'is_dislike' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'torrent_id',
		'post_id',
		'is_like',
		'is_dislike'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
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
