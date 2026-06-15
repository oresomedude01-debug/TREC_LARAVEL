<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set/update a setting value by key.
     *
     * @param string $key
     * @param string|null $value
     * @return void
     */
    public static function set(string $key, ?string $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
