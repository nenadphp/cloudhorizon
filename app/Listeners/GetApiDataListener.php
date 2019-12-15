<?php

namespace App\Listeners;

use App\ApiServices\FetchAppointmentsApiService;
use App\Appointment;
use App\Doctor;
use App\Events\StoreApiDataEvent;
use function GuzzleHttp\Psr7\str;

class GetApiDataListener
{
    /**
     * @var FetchAppointmentsApiService
     */
    private $service;

    /**
     * Create the event listener.
     *
     * @param FetchAppointmentsApiService $service
     */
    public function __construct(FetchAppointmentsApiService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param StoreApiDataEvent $event
     * @throws \App\Exceptions\CustomException
     */
    public function handle(StoreApiDataEvent $event)
    {
        $event->apiData = $this->service->getApiData($event->from);

        foreach ($event->apiData as $key => $data) {

            if (
                !empty((int)$data->id) &&
                !empty((int)$data->patient->id) &&
                !empty((int)$data->doctor->id)
            ) {
                $event->appointments[] = [
                    'external_id'   => (int)$data->id,
                    'patient_id'    => (int)$data->patient->id,
                    'doctor_id'     => (int)$data->doctor->id,
                    'is_cancelled'  => (int)$data->cancelled,
                    'start_date'    => $this->formatDate('Y-m-d', $data->start_date),
                    'start_time'    => $this->formatDate('h:i:s', $data->start_time),
                    'booked_at'     => $this->formatDate('Y-m-d h:i:s', $data->booked_at)
                ];
            }

            if(!empty((int)$data->doctor->id) && ! empty((string)$data->doctor->name)) {
                $event->doctors[] = [
                    'doctor_id'     => (int)$data->doctor->id,
                    'name'          => (string)$data->doctor->name
                ];
            }

            if (!empty((int)$data->clinic->id) && !empty((string)$data->clinic->name)) {
                $event->clinics[] = [
                    'clinic_id'     => (int)$data->clinic->id,
                    'doctor_id'     => (int)$data->doctor->id,
                    'name'          => (string)$data->clinic->name
                ];
            }

            if (!empty((int)$data->patient->id) &&
                !empty((int)$data->doctor->id) &&
                !empty((string)$data->patient->name)
            ) {
                $event->patients[] = [
                    'patient_id'    => (int)$data->patient->id,
                    'doctor_id'     => (int)$data->doctor->id,
                    'name'          => (string)$data->patient->name,
                    'date_of_birth' => $this->formatDate('Y-m-d', $data->patient->date_of_birth),
                    'sex'           => (int)$data->patient->sex,
                ];
            }

            if (!empty((int)$data->specialty->id) &&
                !empty((int)$data->doctor->id) &&
                !empty((string)$data->specialty->name)) {
                $event->specialities[] = [
                    'speciality_id' => (int)$data->specialty->id,
                    'doctor_id'     => (int)$data->doctor->id,
                    'name'          => (string)$data->specialty->name,
                ];
            }
        }
    }

    /**
     * @param string $format
     * @param string $date
     * @return false|string
     */
    private function formatDate(string $format, string $date)
    {
        return date($format, strtotime($date));
    }
}
