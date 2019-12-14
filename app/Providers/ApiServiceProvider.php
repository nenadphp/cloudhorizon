<?php

namespace App\Providers;

use App\ApiServices\ApiRouter;
use App\Appointment;
use App\Clinic;
use App\Doctor;
use App\Specialty;
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
        $this->app->singleton('ApiRouter', function () {
            $apiRouter = new ApiRouter(new Client());
            $apiRouter->setApiUrl('http://ch-api-test.herokuapp.com/xml');
            $apiRouter->setMethod('GET');
            $apiRouter->setObserveObj(new Appointment());
            $apiRouter->setObserveObj(new Clinic());
            $apiRouter->setObserveObj(new Doctor());
            $apiRouter->setObserveObj(new Specialty());
            return $apiRouter->process();
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
