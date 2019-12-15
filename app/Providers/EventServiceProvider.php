<?php

namespace App\Providers;

use App\Events\StoreApiDataEvent;
use App\Listeners\GetApiDataListener;
use App\Listeners\InitAppointmentsListener;
use App\Listeners\InitClinicsListener;
use App\Listeners\InitDoctorsListener;
use App\Listeners\InitPatientsListener;
use App\Listeners\InitSpecialitiesListener;
use App\Listeners\StoreApiDataListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        StoreApiDataEvent::class => [
            GetApiDataListener::class,
            InitAppointmentsListener::class,
            InitDoctorsListener::class,
            InitPatientsListener::class,
            InitClinicsListener::class,
            InitSpecialitiesListener::class,
            StoreApiDataListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
