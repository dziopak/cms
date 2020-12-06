<?php

namespace App\Exceptions\Auth;

use Tymon\JWTAuth\Exceptions\JWTException as Exception;

class JWTException extends Exception
{
    public function response()
    {
        return response()->json('troll');
    }
}
