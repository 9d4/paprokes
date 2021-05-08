<?php

namespace App\Providers;

use App\Services\DeviceService;
use App\Services\NavService;
use App\Services\UserService;
use App\Services\PeopleService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('UserService', UserService::class);
        App::bind('NavService', NavService::class);
        App::bind('PeopleService', PeopleService::class);
        App::bind('DeviceService', DeviceService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
