<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\AppointmentListRequest;
use App\Http\Services\AppointmentService;

/**
 * Class AppointmentController
 * @package App\Http\Controllers
 */
class AppointmentController extends Controller
{
    /**
     * @var AppointmentService $service
     */
    private $service;

    /**
     * AppointmentController constructor.
     * @param AppointmentService $service
     */
    public function __construct(AppointmentService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws CustomException
     */
    public function index()
    {
        try{
            $data = $this->service->index();

            return view('appointments.appointments', compact($data));
        } catch (\Exception $exception) {
            throw new CustomException($exception);
        }
    }

    /**
     * @param AppointmentListRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws CustomException
     */
    public function doctorAppointmentsList(AppointmentListRequest $request)
    {
        try {
            $data = $this->service->getDrAppointmentListByDate(
                $request->get('doctor_id'),
                $request->get('date')
            );

            return view('doctor.doctor-appointments-list', ['data' => $data]);
        } catch (\Exception $exception) {
            throw new CustomException($exception);
        }
    }
}
