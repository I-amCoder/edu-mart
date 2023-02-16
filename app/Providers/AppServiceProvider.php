<?php

namespace App\Providers;

use App\Models\Classes;
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
        // Navbar and footer links for all pages
        view()->composer('layouts.app', function ($view) {

            $view->with('classes', Classes::where('parent_id', 0)->get());
        });
    }
}