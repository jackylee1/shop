<?php

namespace Evention\Services;

use Illuminate\Support\Facades\Facade;

/**
 * @see UserService
 */
class UserService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'service.user';
    }
}