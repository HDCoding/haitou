<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
	use SoftDeletes;
	protected $table = 'news';

	protected $casts = [
		'user_id' => 'int',
		'views' => 'int',
		'is_published' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'name',
		'slug',
		'description',
		'views',
		'is_published'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
