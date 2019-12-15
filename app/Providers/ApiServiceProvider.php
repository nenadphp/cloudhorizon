<?php

namespace App\Providers;

use App\ApiServices\FetchAppointmentsApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FetchAppointmentsApiService::class, function () {
            return new FetchAppointmentsApiService(new Client());;
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
