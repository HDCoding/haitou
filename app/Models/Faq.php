<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $casts = [
        'category_id' => 'int',
        'is_enable' => 'bool'
    ];

    protected $fillable = [
        'category_id',
        'is_enable',
        'question',
        'answer',
        'groups'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
