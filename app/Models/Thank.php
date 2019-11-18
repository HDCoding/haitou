<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thank extends Model
{
	protected $table = 'thanks';

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'calendar_id' => 'int',
		'torrent_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'calendar_id',
		'torrent_id'
	];

	public function calendar()
	{
		return $this->belongsTo(Calendar::class);
	}

	public function torrent()
	{
		return $this->belongsTo(Torrent::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
