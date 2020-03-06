<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ChatroomUser extends Model
{
	protected $table = 'chatroom_users';

	public $incrementing = false;

	protected $casts = [
		'chatroom_id' => 'int',
		'user_id' => 'int',
		'is_admin' => 'bool',
		'can_post' => 'bool'
	];

	protected $fillable = [
		'is_admin',
		'can_post'
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
