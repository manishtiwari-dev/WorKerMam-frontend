<?php

namespace Modules\Pcapi;

use Illuminate\Support\ServiceProvider;

class PcapiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/apipath.php', 'apipath'
        );
        $this->mergeConfigFrom(
            __DIR__.'/config/acceskey.php', 'acceskey', 
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Pcapi');
    }
}