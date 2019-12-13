<?php

namespace App\Helpers;

use App\Models\Setting;
use ArrayAccess;
use Illuminate\Support\Collection;

class Settings implements ArrayAccess
{
    /**
     * Collection of all settings.
     * @var Collection
     */
    private $settings;

    /**
     * Create a new repository instance.
     * @param Collection $settings
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get all settings
     * @return array
     */
    public function all()
    {
        return $this->settings->all();
    }

    /**
     * Get setting for the given key.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->settings->get($key) ?: $default;
    }

    /**
     * Set the given settings.
     * @param array $settings
     * @return void
     */
    public function set($settings = [])
    {
        Setting::setMany($settings);
    }

    /**
     * Determine if an setting is exists.
     * @param string $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->settings->has($key);
    }

    /**
     * Get setting for the given key.
     * @param string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Set a key / value setting pair.
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set([$key => $value]);
    }

    /**
     * Unset a setting by the given key.
     * @return Collection
     */
    public function offsetUnset($key)
    {
        return $this->settings->forget($key);
    }

    /**
     * Get setting for the given key.
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Set a key / value setting pair.
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }
}
