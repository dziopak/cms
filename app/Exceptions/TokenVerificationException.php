<?php

namespace App\Exceptions;

use Exception;

class TokenVerificationException extends Exception
{

    protected $message, $status;

    public function __construct($message, $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function response()
    {
        return response()->json([
            "message" => "Token verification error: " . $this->message,
            "status" => $this->status
        ], $this->status);
    }
}
