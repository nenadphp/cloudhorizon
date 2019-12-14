<?php

namespace App\ApiDataInterfaces;

interface ApiStoreDataInterface
{
    /**
     * @param \SimpleXMLElement $data
     * @return mixed
     */
    public function processData(\SimpleXMLElement $data);
}