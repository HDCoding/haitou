<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
	use SoftDeletes;
	protected $table = 'forums';

	protected $casts = [
		'category_id' => 'int',
		'position' => 'int',
		'views' => 'int'
	];

	protected $fillable = [
		'category_id',
		'position',
		'name',
		'slug',
		'description',
		'icon',
		'views'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
