<?php

namespace App\Models;

use App\Helpers\BBCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Add a settings value
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public static function add($key, $value)
    {
        if (self::has($key)) {
            return self::set($key, $value);
        }
        return self::create(['key' => $key, 'value' => $value]);
    }

    /**
     * Set a value for setting
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public static function set($key, $value)
    {
        if ($setting = self::where('key', '=', $key)->first()) {
            return $setting->update(['key' => $key, 'value' => $value]);
        }
        return self::add($key, $value);
    }

    /**
     * Remove a setting
     *
     * @param $key
     * @return bool
     */
    public static function remove($key)
    {
        if (self::has($key)) {
            return self::where('key', '=', $key)->delete();
        }
        return false;
    }

    /**
     * Get all the settings
     *
     * @return mixed
     */
    public static function getAllSettings()
    {
        return Cache::remember('settings.all', 10 * 60, function () {
            return self::all()->mapWithKeys(function ($setting) {
                return [$setting->key => $setting->value];
            });
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::updated(function () {
            self::flushCache();
        });
        static::created(function () {
            self::flushCache();
        });
        static::deleted(function () {
            self::flushCache();
        });
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('settings.all');
    }

    /**
     * Check if setting exists
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return (boolean)self::where('key', '=', $key)->count();
    }

    /**
     * Get a settings value
     *
     * @param $key
     * @param null $default
     * @return bool|int|mixed
     */
    public static function get($key, $default = null)
    {
        if (self::has($key)) {
            $setting = self::where('key', '=', $key)->select('value')->first();
            return $setting->value;
        }
        return self::getDefaultValue($key, $default);
    }

    /**
     * Get default value from config if no value passed
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    private static function getDefaultValue($key, $default)
    {
        return is_null($default) ? self::getDefaultValueForField($key) : $default;
    }

    public static function getDefaultValueForField($field)
    {
        return self::getDefinedSettingFields()->pluck('value', 'name')->get($field);
    }

    /**
     * Get all the settings fields from config
     *
     * @return Collection
     */
    private static function getDefinedSettingFields()
    {
        return collect(config('settings'))->pluck('elements')->flatten(1);
    }

}
