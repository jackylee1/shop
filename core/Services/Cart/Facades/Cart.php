<?php

namespace Evention\Services\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Evention\Services\CartService
 */
class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'service.cart';
    }
}