<?php

namespace App\Http\Utilities\Api\Users;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;

use Hook;

class UserValidation
{


    static function storeValidation($request)
    {
        $access = AuthResponse::hasAccess();
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'role_id' => 'required|numeric',
            'password' => 'required|min:8',
            'repeat_password' => 'required'
        ];

        $validator = Validator::make($request->all(), $validationFields);
        $validator->after(function ($validator) use ($request) {
            if ($request->get('password') !== $request->get('repeat_password')) {
                $validator->errors()->add('repeat_password', 'Passwords do not match.');
            }
        });

        if ($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        return true;
    }


    static function updateValidation($request)
    {
        $access = AuthResponse::hasAccess('USER_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'unique:users',
            'email' => 'email|unique:users',
            'role_id' => 'numeric',
            'password' => 'string|min:8'
        ];

        $validator = Validator::make($request->all(), $validationFields);
        $validator->after(function ($validator) use ($request) {
            if ($request->get('password') !== $request->get('repeat_password')) {
                $validator->errors()->add('repeat_password', 'Passwords do not match.');
            }
        });

        if ($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        return true;
    }


    static function registerValidation($request)
    {
        $validationFields = [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors()->toJson(), 'status' => '400'], 400);

        return true;
    }
}
