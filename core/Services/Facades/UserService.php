<?php

namespace Evention\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Evention\Services\UserService
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