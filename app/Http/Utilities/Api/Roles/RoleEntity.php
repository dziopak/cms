<?php

namespace App\Http\Utilities\Api\Roles;

use App\Entities\Role;
use App\Http\Resources\RoleResource;
use App\Http\Utilities\Api\AuthResponse;
use App\Interfaces\ApiEntity;

class RoleEntity implements ApiEntity
{

    private $item;


    public function __construct($item)
    {
        $this->$item = $item;
    }


    static function index($request)
    {
        return RoleResource::collection(Role::orderBy('id')->paginate(15));
    }


    public function show()
    {
        if (!$this->item) return response()->json(["status" => "404", "message" => "Role doesn't exist."], 404);
        return new RoleResource($this->item);
    }


    static function store($request)
    {
        $validation = RoleValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        $data = $request->except('access');
        $data['access'] = serialize($request->get('access'));

        $role = new RoleResource(Role::create($data));

        return response()->json([
            "status" => "201",
            "message" => "Successfully created new role.",
            "data" => compact('role')
        ], 201);
    }


    public function update($request)
    {
        $validation = RoleValidation::updateValidation($request);

        if ($validation !== true) return $validation;
        if (!$this->item) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $data = $request->except('access');
        $data['access'] = serialize($request->get('access'));

        $this->item->update($data);

        return response()->json([
            "status" => "201",
            "message" => "Successfully updated the role.",
            "data" => new RoleResource($this->item->fresh())
        ], 201);
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccess('ROLE_DELETE');

        if (!$access === true) return $access;
        if (!$this->item) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $this->item->delete();
        return response()->json([
            "status" => "200",
            "message" => "User role has been successfully deleted.",
            "data" => new RoleResource($this->item)
        ], 200);
    }
}
