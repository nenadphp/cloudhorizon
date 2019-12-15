<?php

namespace App\Listeners;

use App\Clinic;
use App\Events\StoreApiDataEvent;

class InitClinicsListener
{
    /**
     * Handle the event.
     *
     * @param StoreApiDataEvent $event
     * @return void
     */
    public function handle(StoreApiDataEvent $event)
    {
        foreach ($event->clinics as $clinics){

//            if ($this->clinicExist((int)$clinics['clinic_id'])) {
//                continue;
//            }

            Clinic::updateOrCreate([
                'clinic_id'   => $clinics['clinic_id'],
                'doctor_id'   => $clinics['doctor_id'],
                'name'        => $clinics['name']
            ]);
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function clinicExist(int $id)
    {
        return Clinic::where('clinic_id', $id)->first();
    }
}
