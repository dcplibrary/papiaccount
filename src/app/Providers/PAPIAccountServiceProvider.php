<?php

namespace Dcplibrary\PAPIAccount\App\Providers;

use Illuminate\Support\ServiceProvider;

class PAPIAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register package services
        $this->app->singleton('PAPIAccount', function ($app) {
            return new \Dcplibrary\PAPIAccount\PAPIAccount();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load package routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        
        // Load package views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'papiaccount');
        
        // Load package migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/Migrations');
        
        // Load package config
        $this->mergeConfigFrom(__DIR__.'/../../config/papiaccount.php', 'papiaccount');
        
        // Register package commands
        if ($this->app->runningInConsole()) {
            // Publish package config
            $this->publishes([
                __DIR__.'/../../config/papiaccount.php' => config_path('papiaccount.php'),
            ], 'papiaccount-config');
            
            // Publish package views
            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/papiaccount'),
            ], 'papiaccount-views');
        }
    }
}
