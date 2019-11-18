<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mood extends Model
{
	use SoftDeletes;
	protected $table = 'moods';

	protected $casts = [
		'size' => 'int',
		'points' => 'int'
	];

	protected $fillable = [
		'name',
		'image',
		'filename',
		'size',
		'points'
	];
}
