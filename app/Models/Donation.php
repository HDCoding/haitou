<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = 'donations';

    protected $casts = [
        'user_id' => 'int',
        'amount' => 'float'
    ];

    protected $fillable = [
        'user_id',
        'amount',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function descriptionHtml()
    {
        return (new BBCode())->parse($this->description, true);
    }
}
