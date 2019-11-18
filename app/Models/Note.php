<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $table = 'notes';

	protected $casts = [
		'user_id' => 'int',
		'staff_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'staff_id',
		'description'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
