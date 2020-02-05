<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class Log extends Model
{
    protected $table = 'logs';

    protected $casts = [
        'user_id' => 'int',
        'is_mobile' => 'bool',
        'is_tablet' => 'bool',
        'is_desktop' => 'bool',
        'is_staff' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'content',
        'ip',
        'user_agent',
        'system',
        'is_mobile',
        'is_tablet',
        'is_desktop',
        'is_staff'
    ];

    public static function record(string $content, bool $is_staff = false)
    {
        $agent = new Agent();

        return self::create([
            'user_id' => request()->user()->id,
            'content' => $content,
            'ip' => request()->ip(),
            'user_agent' => $agent->browser() ? $agent->browser() : NULL,
            'system' => $agent->platform() ? $agent->platform() : NULL,
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop(),
            'is_staff' => $is_staff
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
