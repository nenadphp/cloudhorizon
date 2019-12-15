<?php

namespace App\Listeners;

use App\Events\StoreApiDataEvent;

class StoreApiDataListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param StoreApiDataEvent $event
     * @return void
     */
    public function handle(StoreApiDataEvent $event)
    {
        try {
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollback();
        }
    }
}
