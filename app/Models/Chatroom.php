<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
	protected $table = 'chatrooms';

	protected $fillable = [
		'name',
		'image'
	];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
