<?php

namespace App;

use App\ApiDataInterfaces\ApiStoreDataInterface;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model implements ApiStoreDataInterface
{
    /**
     * @param \SimpleXMLElement $data
     * @return mixed|void
     */
    public function processData(\SimpleXMLElement $data)
    {
        // TODO: Implement processData() method.
    }
}
