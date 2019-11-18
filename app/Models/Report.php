<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table = 'reports';

	protected $casts = [
		'user_id' => 'int',
		'staff_id' => 'int',
		'calendar_id' => 'int',
		'comment_id' => 'int',
		'member_id' => 'int',
		'post_id' => 'int',
		'torrent_id' => 'int',
		'report_type' => 'int',
		'is_solved' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'staff_id',
		'calendar_id',
		'comment_id',
		'member_id',
		'post_id',
		'torrent_id',
		'report_type',
		'name',
		'slug',
		'reason',
		'solution',
		'is_solved'
	];

	public function calendar()
	{
		return $this->belongsTo(Calendar::class);
	}

	public function comment()
	{
		return $this->belongsTo(Comment::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function torrent()
	{
		return $this->belongsTo(Torrent::class);
	}
}
