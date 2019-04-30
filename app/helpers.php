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