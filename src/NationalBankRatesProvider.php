<?php

namespace Nomikz\NationalBankRates;

use Illuminate\Support\ServiceProvider;

class NationalBankRatesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('nationalbankrates', function($app) {
            return new NationalBankRates(new NationalBankApi(), new Cacher());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nationalbankrates.php', 'nationalbankrates');
    }
}
