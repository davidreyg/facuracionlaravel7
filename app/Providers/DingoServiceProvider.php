<?php

namespace App\Providers;

use Dingo\Api\Provider\DingoServiceProvider as DingoServiceProviders;
use App\Exceptions\ApiHandler as ExceptionHandler;

class DingoServiceProvider extends DingoServiceProviders
{
    /**
     * Register services.
     *
     * @return void
     */
    protected function registerExceptionHandler()
    {
        $this->app->singleton('api.exception', function ($app) {
            return new ExceptionHandler($app['Illuminate\Contracts\Debug\ExceptionHandler'], $this->config('errorFormat'), $this->config('debug'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
