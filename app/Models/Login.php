<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
	protected $table = 'logins';

	protected $casts = [
		'user_id' => 'int',
		'is_mobile' => 'bool',
		'is_tablet' => 'bool',
		'is_desktop' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'ip',
		'user_agent',
		'system',
		'is_mobile',
		'is_tablet',
		'is_desktop'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
