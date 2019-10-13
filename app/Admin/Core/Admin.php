<?php

namespace App\Admin\Core;

class Admin
{
    protected static $resources = [];

    public static function resources($resources)
    {
        static::$resources = array_merge(static::$resources, $resources);
    }

    public static function getResources()
    {
        return collect(static::$resources);
    }

    public static function getNavbarResources()
    {
        return static::getResources()->filter(function($item) {
            return $item::displayInNavigation;
        });
    }

    /**
     * Get the resource class name for a given key.
     *
     * @param  string  $key
     * @return string
     */
    public static function resourceForKey($key)
    {
        return static::getResources()->first(function ($value) use ($key) {
            return $value::uriKey() === $key;
        });
    }
}
