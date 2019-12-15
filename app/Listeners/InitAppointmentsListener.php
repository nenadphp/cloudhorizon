<?php

namespace App\Listeners;

use App\Appointment;
use App\Events\StoreApiDataEvent;
use Illuminate\Support\Facades\DB;

class InitAppointmentsListener
{
    /**
     * Handle the event.
     *
     * @param  StoreApiDataEvent  $event
     * @return void
     */
    public function handle(StoreApiDataEvent $event)
    {
        foreach ($event->appointments as $appointment){
            try {
                DB::beginTransaction();
                $appointmentObj = $this->appointmentExist((int)$appointment['external_id']);

                if($appointmentObj){
                    $appointmentObj->external_id = $appointment['external_id'];
                    $appointmentObj->patient_id = $appointment['patient_id'];
                    $appointmentObj->doctor_id = $appointment['doctor_id'];
                    $appointmentObj->is_cancelled = $appointment['is_cancelled'];
                    $appointmentObj->start_date = $appointment['start_date'];
                    $appointmentObj->start_time = $appointment['start_time'];
                    $appointmentObj->booked_at = $appointment['booked_at'];
                    $appointmentObj->save();
                } else {
                    Appointment::create([
                        'external_id'    => $appointment['external_id'],
                        'patient_id'     => $appointment['patient_id'],
                        'doctor_id'      => $appointment['doctor_id'],
                        'is_cancelled'   => $appointment['is_cancelled'],
                        'start_date'     => $appointment['start_date'],
                        'start_time'     => $appointment['start_time'],
                        'booked_at'      => $appointment['booked_at']
                    ]);
                }

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
            }
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    private function appointmentExist(int $id)
    {
        return Appointment::where('external_id', $id)->first();
    }
}
