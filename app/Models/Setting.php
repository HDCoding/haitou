<?php

namespace App\Models;

use App\Events\SettingSaved;
use App\Helpers\BBCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';

    protected $dispatchesEvents = [
        'saved' => SettingSaved::class
    ];

    protected $fillable = [
        'key',
        'value',
        'type'
    ];

    public function contentHtml()
    {
        return (new BBCode())->parse($this->value, true);
    }

    /**
     * Add a settings value
     *
     * @param $key
     * @param $value
     * @param string $type
     * @return bool
     */
    public static function add($key, $value, $type = 'string')
    {
        if (self::has($key)) {
            return self::set($key, $value, $type);
        }
        return self::create(['key' => $key, 'value' => $value, 'type' => $type]) ? $value : false;
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
            $setting = self::getAllSettings()->where('key', '=', $key)->first();
            return self::castValue($setting->value, $setting->type);
        }
        return self::getDefaultValue($key, $default);
    }

    /**
     * Set a value for setting
     *
     * @param $key
     * @param $value
     * @param string $type
     * @return bool
     */
    public static function set($key, $value, $type = 'string')
    {
        if ($setting = self::getAllSettings()->where('key', '=', $key)->first()) {
            return $setting->update([
                'key' => $key,
                'value' => $value,
                'type' => $type]) ? $value : false;
        }
        return self::add($key, $value, $type);
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
            return self::whereName($key)->delete();
        }
        return false;
    }

    /**
     * Check if setting exists
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return (boolean)self::getAllSettings()->whereStrict('key', '=', $key)->count();
    }

    /**
     * Get the validation rules for setting fields
     *
     * @return array
     */
    public static function getValidationRules()
    {
        return self::getDefinedSettingFields()->pluck('rules', 'key')
            ->reject(function ($value) {
                return is_null($value);
            })->toArray();
    }

    /**
     * Get the data type of a setting
     *
     * @param $field
     * @return mixed
     */
    public static function getDataType($field)
    {
        $type = self::getDefinedSettingFields()->pluck('data', 'key')->get($field);
        return is_null($type) ? 'string' : $type;
    }

    /**
     * Get default value for a setting
     *
     * @param $field
     * @return mixed
     */
    public static function getDefaultValueForField($field)
    {
        return self::getDefinedSettingFields()->pluck('value', 'name')->get($field);
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

    /**
     * Get all the settings fields from config
     *
     * @return Collection
     */
    private static function getDefinedSettingFields()
    {
        return collect(config('settings'))->pluck('elements')->flatten(1);
    }

    /**
     * caste value into respective type
     *
     * @param $value
     * @param $castTo
     * @return bool|int
     */
    private static function castValue($value, $castTo)
    {
        switch ($castTo) {
            case 'int':
            case 'integer':
                return intval($value);
                break;
            case 'bool':
            case 'boolean':
                return boolval($value);
                break;
            default:
                return $value;
        }
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

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('settings.all');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
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

}
