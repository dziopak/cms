<?php

namespace App\Http\Utilities\Api\Roles;

use App\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Utilities\Api\AuthResponse;

class RoleEntity
{


    static function show($id)
    {
        $role = Role::find($id);
        return $role ? new RoleResource($role) : response()->json(["status" => "404", "message" => "Role doesn't exist."], 404);
    }


    static function store($request)
    {
        $validation = RoleValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        $data = $request->except('access');
        $data['access'] = serialize($request->get('access'));

        $role = new RoleResource(Role::create($data));
        return response()->json(["status" => "201", "message" => "Successfully created new role.", "data" => compact('role')], 201);
    }


    static function update($request, $id)
    {
        $validation = RoleValidation::updateValidation($request);
        if ($validation !== true) return $validation;

        $role = Role::find($id);
        if (!$role) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $data = $request->except('access');
        $data['access'] = serialize($request->get('access'));
        $role->update($data);

        return response()->json(["status" => "201", "message" => "Successfully updated the role.", "data" => new RoleResource($role)], 201);
    }


    static function destroy($id)
    {
        $access = AuthResponse::hasAccess('ROLE_DELETE');
        if (!$access === true) return $access;

        $role = Role::find($id);
        if (!$role) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $role->delete();
        return response()->json(["status" => "200", "message" => "User role has been successfully deleted.", "data" => new RoleResource($role)], 200);
    }
}
