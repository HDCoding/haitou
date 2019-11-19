<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;
    protected $table = 'options';
    protected $casts = [
        'poll_id' => 'int'
    ];

    protected $fillable = [
        'poll_id',
        'name'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
