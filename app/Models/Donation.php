<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
	protected $table = 'donations';

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'description'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
