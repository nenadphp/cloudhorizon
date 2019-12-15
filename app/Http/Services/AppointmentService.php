<?php

namespace App\Http\Services;

use App\Appointment;
use App\Doctor;
use App\Specialty;

/**
 * Class AppointmentService
 * @package App\Http\Services
 */
class AppointmentService
{
    /**
     * @var Appointment $model
     */
    private $model;

    /**
     * @var Specialty
     */
    private $speciality;

    /**
     * @var Doctor
     */
    private $doctor;

    /**
     * AppointmentService constructor.
     * @param Appointment $model
     * @param Specialty $specialty
     * @param Doctor $doctor
     */
    public function __construct(Appointment $model, Specialty $specialty, Doctor $doctor)
    {
        $this->model = $model;
        $this->speciality = $specialty;
        $this->doctor = $doctor;
    }

    /**
     * @param int $doctorId
     * @param string $date
     * @return mixed
     */
    public function getDrAppointmentListByDate(int $doctorId, string $date)
    {
        return [
            'data' => $this->model->getDrAppointmentListByDate($doctorId, $date),
            'speciality' => $this->getSpecialities($doctorId),
            'doctor_data' => $this->getDoctorData($doctorId),
        ];
    }

    /**
     * @param int $doctorId
     * @return mixed
     */
    private function getSpecialities(int $doctorId)
    {
        return $this->speciality->where('doctor_id',$doctorId)
            ->select('name')
            ->get();
    }

    /**
     * @param int $doctorId
     * @return mixed
     */
    private function getDoctorData(int $doctorId)
    {
        return $this->doctor->where('doctor_id',$doctorId)->first();
    }
}