<?php

namespace App\Exceptions;

use Exception;

class NotExistingException extends Exception
{
    public $message;

    public function __construct($message = null)
    {
        $this->message = $message ?? "Resource not found";
    }

    public function response()
    {
        return response()->json([
            "message" => "Resource not found",
            "status" => 404
        ], 404);
    }
}
