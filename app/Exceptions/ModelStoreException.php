<?php

namespace App\Exceptions;

use Exception;

class ModelStoreException extends Exception
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
            "message" => "Error during creation of a model: " . $this->message,
            "status" => $this->status
        ], 404);
    }
}
