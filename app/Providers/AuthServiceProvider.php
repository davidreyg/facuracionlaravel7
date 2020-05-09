<?php

namespace App\Providers;

use Dingo\Api\Auth\Provider\JWT;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        app('Dingo\Api\Auth\Auth')->extend('jwt', function ($app) {
            return new JWT($app['Tymon\JWTAuth\JWTAuth']);
        });
        //
    }
}
