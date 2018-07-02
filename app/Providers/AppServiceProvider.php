<?php

namespace KTS\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Schema; 

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void

     */
    public function boot(UrlGenerator $url)
    {
        Schema::defaultStringLength(191);
        if(env('REDIRECT_HTTPS')) {
            $url->formatScheme('HTTPS');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
