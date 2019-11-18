<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
	protected $table = 'searches';

	protected $casts = [
		'user_id' => 'int',
		'results' => 'int',
		'hits' => 'int'
	];

	protected $fillable = [
		'user_id',
		'term',
		'results',
		'hits'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
