<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'external_id',
        'doctor_id',
        'is_cancelled',
        'start_date',
        'start_time',
        'booked_at'
    ];

    /**
     * @param int $doctorId
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getDrAppointmentListByDate(int $doctorId, string $date)
    {
        return DB::table('appointments')
            ->join('doctors','appointments.doctor_id','=','doctors.doctor_id')
            ->join('clinics','doctors.doctor_id','=','clinics.doctor_id')
            ->join('patients','appointments.patient_id','=','patients.patient_id')
            ->where('appointments.doctor_id', $doctorId)
            ->where('appointments.start_date', $date)
            ->where('patients.date_of_birth',"{$this->mark()}", date("Y-m-d",strtotime("-{$this->year()} year")))
            ->orderBy('appointments.external_id')
            ->select(
        'appointments.external_id as external_id',
                'appointments.start_time as start_time',
                'patients.name as patient_name',
                'patients.date_of_birth as patient_date_of_birth',
                'clinics.name as clinic_name'
            )
            ->get();
    }

    /**
     * @return string
     */
    private function mark()
    {
        return!Auth::check() ? '>' : '<';
    }

    /**
     * @return int|string
     */
    private function year()
    {
        return !Auth::check() ? '18' : 0;
    }
}
