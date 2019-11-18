<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fansub extends Model
{
	use SoftDeletes;
	protected $table = 'fansubs';

	protected $casts = [
		'views' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'slug',
		'logo',
		'website',
		'discord',
		'description',
		'views',
		'is_active'
	];
}
