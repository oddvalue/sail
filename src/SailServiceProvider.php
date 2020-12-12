<?php

namespace Laravel\Sail;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class SailServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Laravel\Sail\Console\SailInstall::class,
        \Laravel\Sail\Console\SailPublish::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->configurePublishing();
        }
    }

    public function register()
    {
        //
    }

    /**
     * Register the console commands for the package.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands($this->commands);
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        $this->publishes([
            __DIR__.'/../runtimes' => base_path('docker'),
        ], 'sail');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'sail.install-command',
            'sail.publish-command',
        ];
    }
}
