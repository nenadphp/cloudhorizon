<?php

namespace App\ApiServices;

use App\ApiDataInterfaces\ApiStoreDataInterface;
use App\Exceptions\CustomException;
use GuzzleHttp\Client;

class ApiRouter
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var string $apiKey
     */
    private $apiKey;

    /**
     * @var string $apiUrl
     */
    private $apiUrl;

    /**
     * @var string $method
     */
    private $method;

    /**
     * @var array $observeObj
     */
    public $observeObj = [];

    /**
     * ApiRouter constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getApiUrl():string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl(string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return string
     */
    public function getApiKey():string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiUrl = $apiKey;
    }
    /**
     * @return string
     */
    public function getMethod():string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = strtoupper($method);
    }

    /**
     * @return array
     */
    public function getObserveObj(): array
    {
        return $this->observeObj;
    }

    /**
     * @param ApiStoreDataInterface $objects
     */
    public function setObserveObj(ApiStoreDataInterface $objects):void
    {
        $this->observeObj[] = $objects;
    }

    /**
     * @return \SimpleXMLElement
     * @throws CustomException
     */
    public function getApiData(): \SimpleXMLElement
    {
        try{
            $res = $this->client->request( $this->getMethod(), $this->getApiUrl(), [
                'auth' => [
                    env('API_USER_NAME'), env('API_PASSWORD')
                ],
                'headers' => [
                    'Accept' => 'application/xml'
                ],
            ]);

            if($res->getStatusCode() !== 200){
                throw new CustomException('There is an issue with parsing Api data '. __METHOD__);
            }

            return simplexml_load_string($res->getBody()->getContents());

        } catch (\Exception $exception) {
            throw new CustomException($exception->getMessage());
        }
    }

    /**
     * Observe objects
     *
     * @throws CustomException
     */
    public function process(): void
    {
        $data = $this->getApiData();

        foreach ($this->getObserveObj() as $obj){
            /** ApiStoreDataInterface */
            $obj->processData($data);
        }
    }
}
