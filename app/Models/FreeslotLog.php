<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FreeslotLog extends Model
{
    protected $table = 'freeslot_logs';

    protected $casts = [
        'freeslot_id' => 'int',
        'user_id' => 'int',
        'donated' => 'int'
    ];

    protected $fillable = [
        'freeslot_id',
        'user_id',
        'donated'
    ];

    public function freeslot()
    {
        return $this->belongsTo(Freeslot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
