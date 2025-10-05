<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Paksa gunakan collation yg didukung MariaDB
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);
    }
}
