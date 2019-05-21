<?php

namespace App\Providers;

use App\Listeners\ChangeTemporaryUser;
use App\Listeners\ClearCacheUser;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            ChangeTemporaryUser::class,
            ClearCacheUser::class,
        ],

        Login::class => [
            ChangeTemporaryUser::class,
            ClearCacheUser::class,
        ],

        Logout::class => [
            ClearCacheUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
