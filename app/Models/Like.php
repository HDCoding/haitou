<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	protected $table = 'likes';

	public $incrementing = false;

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'post_id' => 'int'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
