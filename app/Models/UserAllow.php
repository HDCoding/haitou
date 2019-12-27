<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAllow extends Model
{
	protected $table = 'user_allows';

	public $incrementing = false;

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'allow_id' => 'int'
	];

	public function allow()
	{
		return $this->belongsToMany(Allow::class, 'allows');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}