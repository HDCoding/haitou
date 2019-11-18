<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $table = 'files';

	public $timestamps = false;

	protected $casts = [
		'torrent_id' => 'int',
		'size' => 'int'
	];

	protected $fillable = [
		'torrent_id',
		'size',
		'name'
	];

	public function torrent()
	{
		return $this->belongsTo(Torrent::class);
	}
}
