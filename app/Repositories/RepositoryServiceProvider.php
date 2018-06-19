<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Interfaces\IUserRepository::class,
                            UserRepository::class);

        $this->app->singleton(Interfaces\ICategoryRepository::class,
            CategoryRepository::class);

        $this->app->singleton(Interfaces\IProductRepository::class,
            ProductRepository::class);
    }
}