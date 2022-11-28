<?php

namespace Tots\Auth\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Tots\Auth\Guards\AuthGuard;
use Tots\Auth\Services\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService(config('auth'));
        });
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('custom', function ($app, array $config) {
            return new TotsUserProvider();
        });

        Auth::extend('custom', function ($app, $name, array $config) {
            return new AuthGuard(Auth::createUserProvider($config['provider']), $app->make('request'), $app->make(AuthService::class));
        });
    }
}
