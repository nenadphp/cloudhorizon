<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Mail;

class CustomException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //TODO inform admin
        dd($this->getMessage());
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response();
    }
}
