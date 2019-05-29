<?php

namespace Evention\Providers;

use Evention\Console\ServiceMakeCommand;
use Evention\Console\VersionCommand;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Register Modules providers and facade aliases.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register Modules Service Providers
         */
        foreach (config('modules.providers') as $provider)
        {
            $this->app->register($provider);
        }

        /*
         * Register Modules Aliases
         */
        $loader = AliasLoader::getInstance();

        foreach (config('modules.aliases') as $alias => $facade)
        {
            $loader->alias($alias, $facade);
        }
    }
}