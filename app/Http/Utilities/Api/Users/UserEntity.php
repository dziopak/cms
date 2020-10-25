<?php

namespace App\Http\Utilities\Api\Users;

use App\Http\Resources\UserResource;
use App\Http\Utilities\Api\AuthResponse;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserEntity
{


    static function create($request)
    {
        $data = $request->except(['avatar', 'password', 'password_repeat']);
        $data['password'] = Hash::make($request->get('password'));

        return new UserResource(User::create($data));
    }


    static function find($id)
    {
        is_numeric($id) ? $user = User::find($id) : $user = User::where(['email' => $id])->first();
        return $user;
    }


    static function show($id)
    {
        $user = User::find($id);
        return $user ? new UserResource($user) : response()->json(["status" => "404", "message" => "User doesn't exist."], 404);
    }


    static function store($request)
    {
        $validation = UserValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        UserEntity::create($request);
        return response()->json(["status" => "201", "message" => "Successfully created new user account.", "data" => compact('user')], 201);
    }


    static function update($request, $id)
    {
        $validation = UserValidation::updateValidation($request);
        if ($validation !== true) return $validation;

        $user = UserEntity::find($id);
        if (!$user) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $data = $request->except('avatar', 'password', 'repeat_password');
        $user->update($data);

        return response()->json(["status" => "201", "message" => "Successfully updated user account.", "data" => new UserResource($user)], 201);
    }


    static function destroy($id)
    {
        $access = AuthResponse::hasAccess('USER_DELETE');
        if (!$access === true) return $access;

        $user = UserEntity::find($id);
        if (!$user) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $user->delete();
        return response()->json(["status" => "200", "message" => "User has been successfully deleted.", "data" => new UserResource($user)], 200);
    }
}
