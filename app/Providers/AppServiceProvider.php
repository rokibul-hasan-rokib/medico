<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FileManager; // Import the actual class you're working with


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}