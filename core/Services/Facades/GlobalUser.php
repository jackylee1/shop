<?php

namespace Evention\Services\Facades;

use Evention\Services\GlobalUserService;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @see GlobalUserService
 */
class GlobalUser extends Facade
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