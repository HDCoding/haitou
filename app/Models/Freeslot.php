<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Freeslot extends Model
{
    use Sluggable;
    use SoftDeletes;
    protected $table = 'freeslots';

    protected $casts = [
        'required' => 'int',
        'actual' => 'int',
        'days' => 'int',
        'is_freeleech' => 'bool',
        'is_silver' => 'bool',
        'is_doubleup' => 'bool',
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'name',
        'slug',
        'required',
        'actual',
        'days',
        'is_freeleech',
        'is_silver',
        'is_doubleup',
        'is_active',
    ];

    public function type()
    {
        $freeleech = $this->is_freeleech;
        $silver = $this->is_silver;
        $doubleup = $this->is_doubleup;
        $type = '';

        if ($freeleech and $doubleup) {
            $type = ' Freeleech e o Double UP ';
        } elseif ($silver and $doubleup) {
            $type = ' Silver e o Double UP ';
        } elseif ($silver) {
            $type = ' Silver ';
        } elseif ($doubleup) {
            $type = ' Double UP ';
        } elseif ($freeleech) {
            $type  = ' Freeleech ';
        }
        return $type;
    }

    public function percent()
    {
        return $this->actual >= 1 ? number_format(($this->actual / $this->required) * 100, 2, '.', ',') : 0.0;
    }

    public function freeslotlog()
    {
        return $this->hasMany(FreeslotLog::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
