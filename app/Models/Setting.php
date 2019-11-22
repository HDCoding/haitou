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

    public function __construct(BBCode $bbcode)
    {
        parent::__construct();
        $this->bbcode = $bbcode;
    }

    public function termsHtml()
    {
        return $this->bbcode->parse($this->terms, true);
    }

    public function privacyHtml()
    {
        return $this->bbcode->parse($this->privacy, true);
    }

    public function disclaimerHtml()
    {
        return $this->bbcode->parse($this->disclaimer, true);
    }

    public function setting(string $value)
    {
        //TODO: fix key => value
        return self::select($value)->where('id', '=', 1)->pluck($value)->first();
    }
}
