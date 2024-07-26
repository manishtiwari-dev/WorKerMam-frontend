<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session; 
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // $database_suffix = Session::get('db_id');
        // Config::set('database.connections.mysql.database', 'lab_subs_'.$database_suffix);
       // dd($database_suffix);
        Helper::essential_config_regenerate();
        Helper::DBConnect();
    }
}
