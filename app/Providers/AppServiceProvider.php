<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Setting;
use App\Film;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('*', function ($view) {
            $view->with(['setting' => Setting::find(1)]);
        });
        View::composer('*', function ($view) {
            $slide = Film::where('is_slide', 1)->get();
            $view->with(['slide' => $slide]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
