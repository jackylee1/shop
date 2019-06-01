<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CartItem model
    |--------------------------------------------------------------------------
    |
    | This option must have a class name that extends \Evention\Models\CartItem
    |
    */

    'model' => \App\Models\CartItem::class,

    /*
    |--------------------------------------------------------------------------
    | Cart session key
    |--------------------------------------------------------------------------
    |
    | This option must have a unique key
    | for store cart data in session for guests
    |
    */

    'session' => 'cart',
];
