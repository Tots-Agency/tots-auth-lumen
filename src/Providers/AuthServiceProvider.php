<?php

namespace Tots\Auth\Providers;

use Illuminate\Support\ServiceProvider;
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
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        /*$this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return TotsUser::where('api_token', $request->input('api_token'))->first();
            }
        });*/
    }
}
