<?php

namespace App;

use App\ApiDataInterfaces\ApiStoreDataInterface;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model implements ApiStoreDataInterface
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'is_cancelled',
        'start_date',
        'start_time',
        'booked_at'
    ];

    /**
     * @param array $data
     * @return mixed|void
     */
    public function processData(\SimpleXMLElement $data)
    {
        foreach ($data as $appointment){
            self::create([
                'patient_id'     => $appointment->patient->id,
                'doctor_id'      => $appointment->doctor->id,
                'is_cancelled'   =>  isset($appointment->cancelled) &&  is_int($appointment->cancelled) ? 1 : 0,
                'start_date'     => $appointment->start_data,
                'start_time'     => $appointment->start_time,
                'booked_at'      => $appointment->booked_at
            ]);
        }
    }
}