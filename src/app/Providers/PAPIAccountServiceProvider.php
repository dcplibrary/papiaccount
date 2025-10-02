<?php

namespace Dcplibrary\PAPIAccount\App\Providers;

use Blashbrook\PAPIForms\App\Console\Commands\UpdatePatronCodes;
use Blashbrook\PAPIForms\App\Console\Commands\UpdatePatronUdfs;
use Dcplibrary\PAPIAccount\App\Livewire\PatronContact;
use Dcplibrary\PAPIAccount\App\Livewire\PatronDashboard;
use Dcplibrary\PAPIAccount\App\Livewire\PatronInformation;
use Dcplibrary\PAPIAccount\App\Livewire\PatronLocationTest;
use Dcplibrary\PAPIAccount\App\Livewire\PatronLogin;
use Dcplibrary\PAPIAccount\App\Livewire\PatronNotifications;
use Dcplibrary\PAPIAccount\App\Livewire\PatronNotificationsTest;
use Dcplibrary\PAPIAccount\App\Livewire\PatronRenew;
use Dcplibrary\PAPIAccount\PAPIAccount;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PAPIAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register package services
        $this->app->singleton('PAPIAccount', function ($app) {
            return new PAPIAccount();
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
        //$this->loadMigrationsFrom(__DIR__.'/../../database/Migrations');

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

        // Registering Livewire components
        Livewire::component('patron.dashboard', PatronDashboard::class);
        Livewire::component('patron.information', PatronInformation::class);
        Livewire::component('patron.contact', PatronContact::class);
        Livewire::component('patron.login', PatronLogin::class);
        Livewire::component('patron.notifications', PatronNotifications::class);
        Livewire::component('notifications-test', PatronNotificationsTest::class);
        Livewire::component('location-test', PatronLocationTest::class);
        Livewire::component('patron.renew', PatronRenew::class);

        // Registering package commands.
/*        $this->commands([
            UpdatePatronCodes::class,
            UpdatePatronUdfs::class,
            // UpdatePatronStatCodes::class,
        ]);*/
    }
}
