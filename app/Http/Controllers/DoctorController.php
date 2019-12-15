<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Services\DoctorService;

/**
 * Class DoctorController
 * @package App\Http\Controllers
 */
class DoctorController extends Controller
{

    /**
     * @var AppointmentService $service
     */
    private $service;

    /**
     * AppointmentController constructor.
     * @param DoctorService $service
     */
    public function __construct(DoctorService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws CustomException
     */
    public function index()
    {
        try{
            $doctors = $this->service->index();
            $dates = $this->service->getDates();

            return view('doctor.doctor-list', [
                'doctors' => $doctors,
                'dates' => $dates,
            ]);
        } catch (\Exception $exception) {
            throw new CustomException($exception);
        }
    }
}
