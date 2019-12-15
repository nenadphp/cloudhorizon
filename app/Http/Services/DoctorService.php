<?php

namespace App\Http\Services;

use App\Doctor;

/**
 * Class DoctorService
 * @package App\Http\Services
 */
class DoctorService
{
    /**
     * @var Doctor $model
     */
    private $model;

    /**
     * DoctorService constructor.
     * @param Doctor $model
     */
    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }

    /**
     * @return Doctor[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->model->getDoctors();
    }

    /**
     * @return Doctor[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getDates()
    {
        $doctors = $this->model->getDoctors();

        $appointments = [];

        foreach ($doctors as $doctor){
            $appointments[$doctor->doctor_id] = $doctor->appointments()->pluck('start_date')->toArray();
        }

        return $appointments;
    }
}
