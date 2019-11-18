<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
	protected $table = 'categories';

	protected $casts = [
		'is_faq' => 'bool',
		'is_forum' => 'bool',
		'is_media' => 'bool',
		'is_torrent' => 'bool',
		'position' => 'int',
		'views' => 'int'
	];

	protected $fillable = [
		'name',
		'slug',
		'color',
		'icon',
		'is_faq',
		'is_forum',
		'is_media',
		'is_torrent',
		'position',
		'views'
	];
}
