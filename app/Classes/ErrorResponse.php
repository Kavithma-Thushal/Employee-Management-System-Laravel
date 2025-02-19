<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;

class ErrorResponse
{
    public static function throwException(Throwable $e)
    {
        $message = $e->getMessage();
        $status = $e->getStatusCode();
        throw new HttpResponseException(response()->json(["error" => $message], $status));
    }
}
