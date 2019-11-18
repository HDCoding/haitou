<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	protected $table = 'subscriptions';

	public $timestamps = false;

	protected $casts = [
		'topic_id' => 'int',
		'user_id' => 'int',
		'email' => 'bool',
		'notify' => 'bool'
	];

	protected $fillable = [
		'topic_id',
		'user_id',
		'email',
		'notify'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
