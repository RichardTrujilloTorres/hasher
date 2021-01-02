<?php

namespace Cymatica\Hasher;

use Illuminate\Support\ServiceProvider;

class HasherServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/hasher.php', 'hasher');

        $this->app->singleton('hasher.sha256', function ($app) {
            return new Sha512Hasher;
        });

        $this->app->singleton('hasher.sha512', function ($app) {
            return new Sha512Hasher;
        });

        $this->app->singleton('hasher.md5', function ($app) {
            return new Md5Hasher;
        });

        $this->app->singleton('hasher.sha1', function ($app) {
            return new Sha1Hasher;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'hasher.sha256',
            'hasher.sha512',
            'hasher.md5',
            'hasher.sha1',
        ];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/hasher.php' => config_path('hasher.php'),
        ], 'hasher.config');


        // Registering package commands.
        // $this->commands([]);
    }
}
