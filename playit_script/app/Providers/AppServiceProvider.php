<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Schema;

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
        Schema::defaultStringLength(191);
        // Using class Settings
        View::composer(
            '*', 'App\Http\Composers\SettingsComposer'
        );
        // Using class Slider
        View::composer(
            '*', 'App\Http\Composers\SlidersComposer'
        );
        // Using class Movie And Tv Show
        View::composer(
            '*', 'App\Http\Composers\MovieAndTvShowComposer'
        );
    }
}
