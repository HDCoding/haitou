<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chatbox extends Model
{
	protected $table = 'chatbox';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'message',
		'mentions'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
