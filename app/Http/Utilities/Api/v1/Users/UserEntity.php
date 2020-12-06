<?php

namespace App\Http\Utilities\Api\v1\Users;

use App\Http\Resources\UserResource;
use App\Http\Utilities\Api\AuthResponse;
use Illuminate\Support\Facades\Hash;

use App\Entities\User;
use App\Interfaces\ApiEntity;

class UserEntity implements ApiEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    static function index($request)
    {
        return UserResource::collection(User::orderBy('id')->paginate(15));
    }

    static function create($request)
    {
        $data = $request->except(['avatar', 'password', 'password_repeat']);
        $data['password'] = Hash::make($request->get('password'));

        return new UserResource(User::create($data));
    }

    public function show()
    {
        if (empty($this->item)) return response()->json(["status" => "404", "message" => "User doesn't exist."], 404);
        return new UserResource($this->item);
    }


    static function store($request)
    {
        $validation = UserValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        User::create($request);
        return response()->json([
            "status" => "201",
            "message" => "Successfully created new user account.",
            "data" => compact('user')
        ], 201);
    }


    public function update($request)
    {
        $validation = UserValidation::updateValidation($request);
        if ($validation !== true) return $validation;
        if (!$this->item) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $data = $request->except('avatar', 'password', 'repeat_password');
        $this->item->update($data);

        return response()->json(
            [
                "status" => "201",
                "message" => "Successfully updated user account.",
                "data" => new UserResource($this->item->fresh())
            ],
            201
        );
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccessAndRespond('USER_DELETE');

        if (!$access === true) return $access;
        if (!$this->item) return response()->json([
            "status" => "404",
            "message" => "Resource doesn't exist.
        "
        ], 404);

        $this->item->delete();

        return response()->json([
            "status" => "200",
            "message" => "User has been successfully deleted.",
            "data" => new UserResource($this->item)
        ], 200);
    }
}
