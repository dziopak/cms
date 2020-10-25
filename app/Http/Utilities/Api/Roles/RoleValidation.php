<?php

namespace App\Http\Utilities\Api\Roles;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;

use Hook;

class RoleValidation
{


    static function storeValidation($request)
    {
        $access = AuthResponse::hasAccess('ROLE_CREATE');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'required|string|max:255',
            'access' => 'array'
        ];

        $validationFields = Hook::get('apiRolesStoreValidation', [$validationFields], function ($validationFields) {
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);

        return true;
    }


    static function updateValidation($request)
    {
        $access = AuthResponse::hasAccess('ROLE_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'access' => 'array'
        ];
        $validationFields = Hook::get('apiRoleUpdateValidation', [$validationFields], function ($validationFields) {
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);

        return true;
    }
}
