<?php

namespace App\ApiServices;

use App\Exceptions\CustomException;
use App\Transformers\ApiTransformer;
use GuzzleHttp\Client;

/**
 * Class FetchAppointmentsApiService
 * @package App\ApiServices
 */
class FetchAppointmentsApiService
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * FetchAppointmentsApiService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $from
     * @return \SimpleXMLElement
     * @throws CustomException
     */
    public function getApiData(string $from)
    {
        try {
            $datePeriod = $this->getDatePeriod(30, $from);

            $apiData = [];

            foreach ($datePeriod as $key => $date) {
                $res = $this->client->request('GET', 'http://ch-api-test.herokuapp.com/xml?from='.$date, [
                    'auth' => [
                        config('auth.api_appointments.username'),
                        config('auth.api_appointments.password')
                    ],
                    'headers' => [
                        'Accept' => 'application/xml'
                    ]
                ]);

                if ($res->getStatusCode() !== 200) {
                    throw new CustomException('There is an issue with parsing Api data ' . __METHOD__);
                }
                $apiData[] = simplexml_load_string($res->getBody()->getContents());
            }

            return ApiTransformer::transform($apiData);
        } catch (\Exception $exception) {
            throw new CustomException($exception->getMessage());
        }
    }

    /**
     * @param int $days
     * @param $from
     * @return array
     * @throws \Exception
     */
    private function getDatePeriod(int $days, $from)
    {
        $from = implode(' ',explode('%', $from));
        $requestDate = [];
        $period = new \DatePeriod(new \DateTime($from),
            new \DateInterval('P1D'),
            new \DateTime( $from.' +'.$days.' day')
        );
        foreach ($period as $date) {
            $requestDate[] = str_replace(' ','%',$date->format("Y-m-d 2014:H:i"));
        }

        return $requestDate;
    }
}
