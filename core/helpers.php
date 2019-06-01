<?php

if (! function_exists('isRoute')) {

    /**
     * Helper to determinate if name of route is current route.
     *
     * @param $name
     * @return bool
     */
    function isRoute($name)
    {
        return $name == Route::currentRouteName();
    }
}

if (! function_exists('setting')) {

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

if (! function_exists('price')) {

    /**
     * Helper to format price.
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

if (! function_exists('bool_string')) {

    /**
     * bool type to string 'true' or 'false'.
     *
     * @param bool
     *
     * @return string
     */
    function bool_string(bool $value)
    {
        return $value ? 'true' : 'false';
    }
}

if (! function_exists('bookmarks_count')) {

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

if (! function_exists('user')) {

    /**
     * Get current user.
     *
     * @return \App\Models\User\User|\App\Models\User\TemporaryUser
     */
    function user()
    {
        if (auth()->guest()) {
            return \Evention\Services\Facades\TemporaryUser::user();
        }

        return auth()->user();
    }
}

if (! function_exists('temp_user')) {

    /**
     * @return \App\Models\User\TemporaryUser
     */
    function temp_user()
    {
        return \Evention\Services\Facades\TemporaryUser::user();
    }
}

if (! function_exists('user_type')) {

    /**
     * Return the current or giver user type.
     *
     * @param \App\Models\User\User|\App\Models\User\TemporaryUser
     *
     * @return string
     */
    function user_type($user = null)
    {
        if (! is_null($user)) {
            return $user instanceof \App\Models\User\TemporaryUser
                ? ' temporary_user'
                : 'user';
        }

        return auth()->guest() ? 'temporary_user' : 'user';
    }
}
