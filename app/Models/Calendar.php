<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
	use SoftDeletes;
	protected $table = 'calendars';

	protected $casts = [
		'user_id' => 'int',
		'is_enabled' => 'bool',
		'views' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'user_id',
		'name',
		'slug',
		'description',
		'color',
		'is_enabled',
		'views',
		'start_date',
		'end_date'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
