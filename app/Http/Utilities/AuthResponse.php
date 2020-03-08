<?php

    namespace App\Http\Utilities;

    use App\User;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use JWTAuth;

    class AuthResponse {

        static function hasAccess($access = null) {

            $user = User::jwtUser();
            if ( !empty($user) && !empty($user = User::find($user->id)) ) {
                try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['message' => 'User not found.', 'status' => '404'], 404);
                    }
                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['message' => 'Token expired.', 'status' => $e->getStatusCode()], $e->getStatusCode());
                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['message' => 'Invalid token.', 'status' => $e->getStatusCode()], $e->getStatusCode());
                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['message' => 'Authorization token is absent.', 'status' => $e->getStatusCode()], $e->getStatusCode());
                }
                
                if (empty($access) || (!empty($access) && $user->hasAccess($access))) {
                    return true;    
                } else {
                    return response()->json(['message' => 'You don\'t have permision to access this data.', 'status' => '403'], 403);
                }
            } else {
                return response()->json(['message' => 'User not logged in.', 'status' => '403'], 403);
            }
            
        }

        static function authAndRespond($data) {
            try {
                if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
                }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['message' => 'Token expired.', 'status' => $e->getStatusCode()], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['message' => 'Invalid token.', 'status' => $e->getStatusCode()], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['message' => 'Authorization token is absent.', 'status' => $e->getStatusCode()], $e->getStatusCode());
            }

            return response()->json($data, 200);
        }

    }
