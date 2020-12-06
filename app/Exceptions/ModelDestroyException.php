<?php

namespace App\Exceptions;

use Exception;

class ModelDestroyException extends Exception
{
    public $message;

    public function __construct($message, $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function response()
    {
        return response()->json([
            "message" => "Error during deleting selected models: " . $this->message,
            "status" => $this->status
        ], 404);
    }
}
