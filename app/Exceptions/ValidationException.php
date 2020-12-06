<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function toArray()
    {
        return [
            'errors' => $this->errors
        ];
    }

    public function response()
    {
        return response()->json([
            'status' => 400,
            'message' => 'Validation error',
            'data' => $this->errors,
        ], 400);
    }
}
