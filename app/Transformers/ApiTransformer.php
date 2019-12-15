<?php

namespace App\Transformers;

class ApiTransformer
{
    /**
     * @param array $apiData
     * @return array
     */
    public static function transform(array $apiData):array
    {
        $prepareData = [];
        foreach ($apiData as $key => $value) {
            foreach ($value->appointment as $app) {
                $prepareData[] = $app;
            }
        }
        return $prepareData;
    }
}
