<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
	use SoftDeletes;
	protected $table = 'actors';

	protected $casts = [
		'views' => 'int'
	];

	protected $dates = [
		'birthday'
	];

	protected $fillable = [
		'name',
		'slug',
		'image',
		'website',
		'description',
		'birthday',
		'views'
	];
}
