<?php

namespace Modules\UserManage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class UserManageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/apipath.php',
            'apipath'
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
        Paginator::useBootstrap();
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'UserManage');
    }
}
