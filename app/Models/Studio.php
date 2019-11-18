<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
	use SoftDeletes;
	protected $table = 'studios';

	protected $casts = [
		'views' => 'int'
	];

	protected $fillable = [
		'name',
		'slug',
		'logo',
		'website',
		'description',
		'views'
	];
}
