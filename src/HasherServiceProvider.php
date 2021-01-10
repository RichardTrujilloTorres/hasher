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
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        app('hash')->extend('sha256', function () {
            return new Sha256Hasher;
        });

        app('hash')->extend('sha512', function () {
            return new Sha512Hasher;
        });

        app('hash')->extend('sha1', function () {
            return new Sha1Hasher;
        });

        app('hash')->extend('md5', function () {
            return new Md5Hasher;
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/hasher.php', 'hasher');

        $this->app->singleton('hash.sha256', function ($app) {
            return new Sha256Hasher;
        });

        $this->app->singleton('hash.sha512', function ($app) {
            return new Sha512Hasher;
        });

        $this->app->singleton('hash.sha1', function ($app) {
            return new Sha1Hasher;
        });

        $this->app->singleton('hash.md5', function ($app) {
            return new Md5Hasher;
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
            'hash.sha256',
            'hash.sha512',
            'hash.sha1',
            'hash.md5',
        ];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__.'/../config/hasher.php' => config_path('hasher.php'),
        ], 'hasher.config');

        // Registering package commands.
        // $this->commands([]);
    }
}
