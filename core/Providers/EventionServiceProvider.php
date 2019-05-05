<?php

namespace Evention\Providers;

use Evention\Contracts\CoreContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class EventionServiceProvider extends ServiceProvider
{
    /**
     * Create a new service provider instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(Application $app)
    {
        //$app->make(CoreContract::class);

        parent::__construct($app);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('bool', function ($expresion) {
            return "<?php echo bool_string({$expresion}) ?>";
        });
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
        $this->app->make(CoreContract::class);

        //
    }
}