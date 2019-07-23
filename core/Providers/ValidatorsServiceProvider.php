<?php

namespace Evention\Providers;

use Evention\Contracts\CoreContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class ValidatorsServiceProvider extends ServiceProvider
{
    /**
     * Create a new service provider instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (config('validators') as $name => $class)
        {
            Validator::extend($name, $class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
