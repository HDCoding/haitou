<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FailedLogin extends Model
{
	protected $table = 'failed_logins';

	protected $casts = [
		'user_id' => 'int',
		'is_desktop' => 'bool',
		'is_mobile' => 'bool',
		'is_tablet' => 'bool',
		'is_bot' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'email',
		'ip',
		'user_agent',
		'bot',
		'os_family',
		'os',
		'browser_family',
		'browser',
		'is_desktop',
		'is_mobile',
		'is_tablet',
		'is_bot'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
