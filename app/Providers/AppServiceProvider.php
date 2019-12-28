<?php

namespace App\Providers;

use App\Helpers\Toastr;
use Illuminate\Http\Resources\Json\Resource;
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
        //Toastr
        $this->app->singleton('toastr', function ($app) {
            return new Toastr($app['session'], $app['config']);
        });

        // Return apis without: data[]
        Resource::withoutWrapping();

        // X-Powered-By Attack
        header_remove('X-Powered-By');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
