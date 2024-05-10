<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            if (!empty(auth()->user()->role)) {
                if (auth()->user()->role == "admin") {
                    return 1;
                }
            }
            return 0;
        });

        Blade::if('notCustomer', function () {
            if (!empty(auth()->user()->role)) {
                if (auth()->user()->role == "admin" || auth()->user()->role == "penjual") {
                    return 1;
                }
            }
            return 0;
        });
    }
}
