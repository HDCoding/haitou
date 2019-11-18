<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
	protected $table = 'posts';

	protected $casts = [
		'forum_id' => 'int',
		'topic_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'forum_id',
		'topic_id',
		'user_id',
		'post_username',
		'content'
	];

	public function forum()
	{
		return $this->belongsTo(Forum::class);
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
