<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'states';

	public $timestamps = false;

	protected $fillable = [
		'name',
		'uf',
		'flag'
	];
}
