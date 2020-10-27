<?php

namespace App\Http\Utilities\Api\Users;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

use App\Entities\User;
use JWTAuth;

class UserAuthentication
{
    static function register($request)
    {
        $validation = UserValidation::registerValidation($request);
        if ($validation !== true) return $validation;

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user['token'] = JWTAuth::fromUser($user);

        return response()->json(["message" => "Successfully registered new user account.", "user" => $user, "status" => 201], 201);
    }


    static function authenticateCredentials($credentials)
    {
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid login credentials.', 'status' => '400'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['Message' => 'Error while creating the token', 'status' => '500'], 500);
        }

        return response()->json(['token' => $token, 'status' => 200]);
    }
}
