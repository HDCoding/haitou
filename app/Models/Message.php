<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = 'messages';

	protected $casts = [
		'chatroom_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'chatroom_id',
		'user_id',
		'content'
	];

	public function chatroom()
	{
		return $this->belongsTo(Chatroom::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
