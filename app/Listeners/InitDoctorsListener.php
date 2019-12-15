<?php

namespace App\Listeners;

use App\Doctor;
use App\Events\StoreApiDataEvent;

class InitDoctorsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param StoreApiDataEvent $event
     * @return void
     */
    public function handle(StoreApiDataEvent $event)
    {
        foreach ($event->doctors as $doctor){
            if ($this->isDoctorExist((int)$doctor['doctor_id'])) {
                continue;
            }
            Doctor::updateOrCreate([
                'doctor_id'   => $doctor['doctor_id'],
                'name'        => $doctor['name']
            ]);
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function isDoctorExist(int $id)
    {
        return Doctor::where('doctor_id', $id)->first();
    }
}
