<?php

namespace App\Listeners;

use App\Events\StoreApiDataEvent;
use App\Patient;

class InitPatientsListener
{
    /**
     * Handle the event.
     *
     * @param StoreApiDataEvent $event
     * @return void
     */
    public function handle(StoreApiDataEvent $event)
    {
        foreach ($event->patients as $patient){
            if ($this->patientExist((int)$patient['patient_id'])) {
                continue;
            }

            Patient::updateOrCreate([
                'patient_id'    => $patient['patient_id'],
                'doctor_id'     => $patient['doctor_id'],
                'name'          => $patient['name'],
                'date_of_birth' => $patient['date_of_birth'],
                'sex'           => $patient['sex']
            ]);
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function patientExist(int $id)
    {
        return Patient::where('patient_id', $id)->first();
    }
}
