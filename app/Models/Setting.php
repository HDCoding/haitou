<?php

namespace App\Models;

use App\Events\SettingSaved;
use App\Helpers\BBCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';

    protected $dispatchesEvents = [
        'saved' => SettingSaved::class
    ];

    protected $fillable = [
        'display_name',
        'key',
        'value'
    ];

    public function contentHtml()
    {
        return (new BBCode())->parse($this->value, true);
    }

    /**
     * Get all settings with cache support.
     * @return mixed
     */
    public static function allCached()
    {
        return Cache::tags(['settings'])->rememberForever('settings.all:pt-br', function () {
            return self::all()->mapWithKeys(function ($setting) {
                return [$setting->key => $setting->value];
            });
        });
    }

    /**
     * Determine if the given setting key exists.
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return static::where('key', $key)->exists();
    }

    /**
     * Get setting for the given key.
     * @param string $key
     * @param mixed $default
     * @return string|array
     */
    public static function get($key, $default = null)
    {
        return static::where('key', $key)->first()->value ?? $default;
    }

    /**
     * Set the given setting.
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Set the given settings.
     * @param $settings
     */
    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    /**
     * Get the value of the setting.
     * @return mixed
     */
    public function getValueAttribute()
    {
        return unserialize($this->value);
    }

    /**
     * Set the value of the setting.
     * @param $value
     */
    public function setPlainValueAttribute($value)
    {
        $this->attributes['value'] = serialize($value);
    }
}
