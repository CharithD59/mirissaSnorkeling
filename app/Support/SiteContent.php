<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;

/**
 * Reads editable website content. Values saved in `site_settings` override the
 * defaults declared in config/site_content.php.
 */
class SiteContent
{
    protected static $values = null;
    protected static $definitions = null;

    public static function definitions()
    {
        if (static::$definitions === null) {
            static::$definitions = [];
            foreach (config('site_content', []) as $groupKey => $group) {
                foreach ($group['fields'] as $key => $field) {
                    $field['group'] = $groupKey;
                    static::$definitions[$key] = $field;
                }
            }
        }
        return static::$definitions;
    }

    public static function values()
    {
        if (static::$values === null) {
            static::$values = [];
            try {
                if (Schema::hasTable('site_settings')) {
                    static::$values = SiteSetting::query()->pluck('value', 'key')->all();
                }
            } catch (\Throwable $e) {
                // Database not reachable yet: fall back to defaults so the website still renders.
            }
        }
        return static::$values;
    }

    public static function get($key, $default = null)
    {
        $values = static::values();
        if (array_key_exists($key, $values) && $values[$key] !== null) {
            return $values[$key];
        }
        $definitions = static::definitions();
        if (isset($definitions[$key]) && array_key_exists('default', $definitions[$key])) {
            return $definitions[$key]['default'];
        }
        return $default;
    }

    public static function set($key, $value)
    {
        SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        static::$values = null;
    }

    public static function forget($key)
    {
        SiteSetting::query()->where('key', $key)->delete();
        static::$values = null;
    }

    public static function flush()
    {
        static::$values = null;
    }
}
