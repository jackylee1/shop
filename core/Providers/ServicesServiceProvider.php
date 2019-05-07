<?php

namespace Evention\Providers;

use Evention\Services\BookmarkService;
use Evention\Services\SettingsService;
use Evention\Services\TemporaryUserService;
use Evention\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Array of services need to register
     *
     * @var array
     */
    protected $services = [
        SettingsService::class,
        TemporaryUserService::class,
        UserService::class,
        BookmarkService::class,
    ];

    /**
     * Array of services aliases
     *
     * @var array
     */
    protected $alias = [
        UserService::class => 'user',
        SettingsService::class => 'setting',
        BookmarkService::class => 'bookmark',
        TemporaryUserService::class => 'temporary_user',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        foreach ($this->services as $service)
        {
            if(isset($this->alias[$service])) {
                $name = "service.". $this->alias[$service];

                $this->app->alias("service.". $this->alias[$service], $service);
            } else {
                $name = $service;
            }

            $this->app->singleton($service);
            $this->app->instance($name, $this->app->make($service));
        }
    }
}