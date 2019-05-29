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
        $this->loadBladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(CoreContract::class);

        //
    }

    /**
     * Load Blade Directives
     *
     * @return void
     */
    protected function loadBladeDirectives()
    {
        \Blade::directive('bool', function ($expresion) {
            return "<?php echo bool_string({$expresion}) ?>";
        });
    }
}