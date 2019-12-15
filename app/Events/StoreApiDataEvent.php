<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

/**
 * Class StoreApiDataEvent
 * @package App\Events
 */
class StoreApiDataEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    public $apiData;

    /**
     * @var array
     */
    public $appointments = [];

    /**
     * @var array
     */
    public $doctors = [];

    /**
     * @var array
     */
    public $clinics = [];

    /**
     * @var array
     */
    public $patients = [];

    /**
     * @var array
     */
    public $specialities = [];

    /**
     * @var string
     */
    public $from;

    /**
     * StoreApiDataEvent constructor.
     * @param $from
     */
    public function __construct($from)
    {
        $this->from = $from;
    }
}
