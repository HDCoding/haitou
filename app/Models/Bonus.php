<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use SoftDeletes;
    protected $table = 'bonus';

    protected $casts = [
        'cost' => 'int',
        'quantity' => 'int',
        'bonus_type' => 'int',
        'bytes' => 'int',
        'is_enabled' => 'bool'
    ];

    protected $fillable = [
        'name',
        'cost',
        'quantity',
        'bonus_type',
        'bytes',
        'is_enabled'
    ];

    public function type()
    {
        switch ($this->bonus_type) {
            case 0: echo 'Download'; break;
            case 1: echo 'Upload'; break;
            case 2: echo 'Freeleech'; break;
            case 3: echo 'Advertência'; break;
            case 4: echo 'Convite'; break;
            case 5: echo 'Slots'; break;
            default: echo 'Bug'; break;
        }
    }

    public function bytes()
    {
        switch ($this->bytes) {
            case 0: return 'MB'; break;
            case 1: return 'GB'; break;
            case 2: return 'TB'; break;
            default: return 'Bug'; break;
        }
    }

    public function enabled()
    {
        if ($this->is_enabled) {
            return '<span class="badge badge-outline-success">Ativado</span>';
        } else {
            return '<span class="badge badge-outline-danger">Desativado</span>';
        }
    }

    public function value($decimals = 2)
    {
        $bytes = $this->quantity;

        if (!empty($bytes)) {
            $floor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $floor));
        }
        return $bytes;
    }
}
