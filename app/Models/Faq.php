<?php

namespace App\Models;

use App\Helpers\BBCode;
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

    public function answerHtml()
    {
        return (new BBCode())->parse($this->answer, true);
    }
}
