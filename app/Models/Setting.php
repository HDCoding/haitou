<?php

namespace App\Models;

use App\Helpers\BBCode;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';

    protected $bbcode;

    protected $fillable = [
        'display_name',
        'key',
        'value'
    ];

    public function contentHtml()
    {
        return (new BBCode())->parse($this->value, true);
    }

    public function setting(string $value)
    {
        //TODO: fix key => value
        return self::select($value)->where('id', '=', 1)->pluck($value)->first();
    }
}
