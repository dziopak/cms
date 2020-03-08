<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\UserResource;
use App\User;
use App\Http\Utilities\AuthResponse;
use JWTAuth;

class UsersController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid login credentials.', 'status' => '400'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['Message' => 'Error while creating the token', 'status' => '500'], 500);
        }

        return response()->json(['token' => $token, 'status' => 200]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors()->toJson(), 'status' => '400'], 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user['token'] = $token = JWTAuth::fromUser($user);
         
        return response()->json($user, 201);
    }

    public function getAuthenticatedUser()
    {
        $response = AuthResponse::authAndRespond(JWTAuth::parseToken()->authenticate());
        return $response;
    }
}