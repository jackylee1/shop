<?php

namespace Evention\Modules\Cart;

use Illuminate\Auth\Events\Logout;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cart', Cart::class);

        $this->app['events']->listen(Logout::class, function () {
            $this->app->make(SessionManager::class)->forget(config('cart.session'));
        });
    }
}