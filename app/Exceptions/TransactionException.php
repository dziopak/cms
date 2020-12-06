<?php

namespace App\Exceptions;

use Exception;

class TransactionException extends Exception
{
    public function response()
    {
        // TO DO //
        // STATUS CODE //
        return response()->json([
            'status' => 400,
            'message' => 'Unknown database error occured.'
        ], 400);
    }
}
