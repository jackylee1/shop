<?php

namespace Evention\Providers;

use Evention\Console\ServiceMakeCommand;
use Evention\Console\VersionCommand;
use Illuminate\Support\ServiceProvider;

class CommandsServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'Version' => 'command.evention.version',
        'ServiceMake' => 'command.evention.make.service',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands($this->commands);
    }

    /**
     * Register the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerVersionCommand()
    {
        $this->app->singleton('command.evention.version', function ($app) {
            return new VersionCommand();
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerServiceMakeCommand()
    {
        $this->app->singleton('command.evention.make.service', function ($app) {
            return $app->make(ServiceMakeCommand::class);
        });
    }
}