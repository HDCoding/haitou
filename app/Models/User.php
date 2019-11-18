<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'mood_id' => 'int',
		'group_id' => 'int',
		'state_id' => 'int',
		'status' => 'int',
		'uploaded' => 'int',
		'downloaded' => 'int',
		'points' => 'int',
		'experience' => 'int',
		'reputation' => 'int',
		'invites' => 'int',
		'max_slots' => 'int',
		'is_warned' => 'bool',
		'is_donor' => 'bool',
		'birth_gifted' => 'bool',
		'readed_rules' => 'bool',
		'time_online' => 'int',
		'views' => 'int',
		'show_achievements' => 'bool',
		'show_mood' => 'bool',
		'show_state' => 'bool',
		'show_role' => 'bool',
		'show_downloaded' => 'bool',
		'show_uploaded' => 'bool',
		'show_profile' => 'bool',
		'show_profile_points' => 'bool',
		'show_profile_level' => 'bool',
		'show_profile_info' => 'bool',
		'show_profile_title' => 'bool',
		'show_profile_signature' => 'bool',
		'show_profile_birthday' => 'bool',
		'show_profile_social_links' => 'bool',
		'show_profile_friends' => 'bool',
		'show_profile_warning' => 'bool',
		'show_forum_signatures' => 'bool',
		'receive_email' => 'bool',
		'torrents_per_page' => 'int',
		'topics_per_page' => 'int',
		'posts_per_page' => 'int'
	];

	protected $dates = [
		'birthday',
		'activated_at',
		'disabled_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'mood_id',
		'group_id',
		'state_id',
		'username',
		'slug',
		'email',
		'password',
		'status',
		'uploaded',
		'downloaded',
		'points',
		'experience',
		'reputation',
		'invites',
		'max_slots',
		'passkey',
		'avatar',
		'cover',
		'info',
		'title',
		'signature',
		'birthday',
		'is_warned',
		'is_donor',
		'birth_gifted',
		'readed_rules',
		'time_online',
		'css_style',
		'code',
		'views',
		'show_achievements',
		'show_mood',
		'show_state',
		'show_role',
		'show_downloaded',
		'show_uploaded',
		'show_profile',
		'show_profile_points',
		'show_profile_level',
		'show_profile_info',
		'show_profile_title',
		'show_profile_signature',
		'show_profile_birthday',
		'show_profile_social_links',
		'show_profile_friends',
		'show_profile_warning',
		'show_forum_signatures',
		'receive_email',
		'facebook',
		'twitter',
		'linkedin',
		'instagram',
		'pinterest',
		'torrents_per_page',
		'topics_per_page',
		'posts_per_page',
		'remember_token',
		'activated_at',
		'disabled_at'
	];

	public function group()
	{
		return $this->belongsTo(Group::class);
	}

	public function mood()
	{
		return $this->belongsTo(Mood::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}
}
