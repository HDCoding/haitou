<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
	protected $table = 'lotteries';

	protected $casts = [
		'user_if' => 'int',
		'is_enable' => 'bool',
		'is_vip' => 'bool',
		'is_upload' => 'bool',
		'is_points' => 'bool',
		'is_invites' => 'bool',
		'is_share' => 'bool',
		'vip_days' => 'int',
		'ticket_per_user' => 'int',
		'max_select' => 'int',
		'max_numbers' => 'int',
		'invites' => 'int',
		'ticket_cost' => 'int',
		'win_percent' => 'int',
		'upload' => 'int',
		'points' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'user_if',
		'name',
		'slug',
		'groups',
		'numbers',
		'is_enable',
		'is_vip',
		'is_upload',
		'is_points',
		'is_invites',
		'is_share',
		'vip_days',
		'ticket_per_user',
		'max_select',
		'max_numbers',
		'invites',
		'ticket_cost',
		'win_percent',
		'upload',
		'points',
		'description',
		'start_date',
		'end_date'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_if');
	}
}
