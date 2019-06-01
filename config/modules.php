<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Modules Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */
    'providers' => [
          \Evention\Modules\Cart\CartServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Modules Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [
        'Cart' => \Evention\Modules\Cart\Facades\Cart::class,
    ],
];
