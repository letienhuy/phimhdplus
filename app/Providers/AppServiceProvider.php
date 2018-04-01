<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Setting;
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
        View::composer('master', function ($view) {
            $view->with(['setting' => Setting::find(1)]);
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
