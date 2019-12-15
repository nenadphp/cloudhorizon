<?php

namespace App\Listeners;

use App\Events\StoreApiDataEvent;
use App\Specialty;

class InitSpecialitiesListener
{
    /**
     * Handle the event.
     *
     * @param StoreApiDataEvent $event
     * @return void
     */
    public function handle(StoreApiDataEvent $event)
    {
        foreach ($event->specialities as $speciality){
            if ($this->specialityExist((int)$speciality['speciality_id'])) {
                continue;
            }

            Specialty::updateOrCreate([
                'speciality_id'    => $speciality['speciality_id'],
                'doctor_id'        => $speciality['doctor_id'],
                'name'             => $speciality['name']
            ]);
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function specialityExist(int $id)
    {
        return Specialty::where('speciality_id', $id)->first();
    }
}
