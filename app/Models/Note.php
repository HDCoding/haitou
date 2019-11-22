<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $casts = [
        'user_id' => 'int',
        'staff_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'staff_id',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
