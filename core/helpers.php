<?php

if(! function_exists('isRoute')) {

    /**
     * Helper to determinate if name of route is current route.
     *
     * @param $name
     * @return boolean
     */
    function isRoute($name)
    {
        return $name == Route::currentRouteName();
    }
}

if(! function_exists('setting')) {

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    function setting($key, $default = null)
    {
        return \Evention\Services\SettingsService::get($key, $default);
    }
}

if(! function_exists('price')) {

    /**
     * Helper to format price
     *
     * @param $amount
     * @return string
     */
    function price($amount)
    {
        $price = number_format($amount, 2, '.', ' ');

        return \Illuminate\Support\Str::replaceLast('.00', '', $price);
    }
}

if(! function_exists('bool_string')) {

    /**
     * bool type to string 'true' or 'false'
     *
     * @param boolean
     *
     * @return string
     */
    function bool_string(bool $value)
    {
        return $value ? 'true' : 'false';
    }
}


if(! function_exists('bookmarks_count')) {

    /**
     * @param bool $force
     *
     * @return int
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    function bookmarks_count($force = false)
    {
        return \Evention\Services\BookmarkService::getCountBookmarks($force);
    }
}