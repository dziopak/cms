<?php

namespace App\Http\Utilities\Api;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Exceptions\TokenVerificationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Entities\User;
use JWTAuth;

class AuthResponse
{

    static function checkAccess($access)
    {
        if (empty($access)) return true;
        $user = User::jwtUser();

        try {
            if (empty($user) || empty($user::find($user->id))) return ['User not found', 404];
            if (!JWTAuth::parseToken()->authenticate()) return ['User not found', 404];
            if (!$user->hasAccess($access)) return ['No permission', 400];
        } catch (TokenExpiredException $e) {
            return ['Token expired', $e->getCode()];
        } catch (TokenInvalidException $e) {
            return ['Invalid token', $e->getCode()];
        } catch (JWTException $e) {
            return ['Authorization token absent', $e->getCode()];
        }

        return true;
    }


    static function authAndRespond($data)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) return response()->json(['message' => 'User not found', 'status' => 404], 404);
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token expired.', 'status' => $e->getCode()], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Invalid token.', 'status' => $e->getCode()], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['message' => 'Authorization token is absent.', 'status' => $e->getCode()], $e->getCode());
        }

        return response()->json($data, 200);
    }


    static function hasAccess($access = null, $log = false)
    {
        if (empty($access) || $res = self::checkAccess($access) === true) return true;

        throw new TokenVerificationException($res[0], $res[1]);
        return $log ? $res[0] : false;
    }

    static function hasAccessAndRespond($access = null)
    {
        $res = self::checkAccess($access);
        if (empty($access) || $res === true) return true;

        throw new TokenVerificationException($res[0], $res[1]);
        return response()->json(["message" => $res[0], "status" => $res[1]], $res[1]);
    }
}
