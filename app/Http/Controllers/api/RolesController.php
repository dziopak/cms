<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\AuthResponse;
use App\Http\Utilities\RoleUtilities;

use App\Role;
use App\Http\Resources\RoleResource;
use Hook;

class RolesController extends Controller
{
    public function index() {
        return RoleResource::collection(Role::orderBy('id')->paginate(15));
    }


    public function show($id)
    {
        $role = Role::find($id);
        return $role ? new RoleResource($role) : response()->json(["status" => "404", "message" => "Role doesn't exist."], 404);
    }


    public function store(Request $request)
    {
        $access = AuthResponse::hasAccess('ROLE_CREATE');
        $validation = RoleUtilities::storeValidation($request);
        
        if ($access !== true) return $access;
        if ($validation !== true) return $validation;

        $data = $request->except('access');
        $data['access'] = serialize($request->get('access'));

        $role = new RoleResource(Role::create($data));
        return response()->json(["status" => "201", "message" => "Successfully created new role.", "data" => compact('role')], 201);
    }


    public function update(Request $request, $id)
    {
        $access = AuthResponse::hasAccess('ROLE_EDIT');
        $validation = RoleUtilities::updateValidation($request);
        
        if ($access !== true) return $access;
        if ($validation !== true) return $validation;

        $role = Role::find($id);
        if (!$role) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);     
                
        $data = $request->except('access');
        $data['access'] = serialize($request->get('access'));
        $role->update($data);
    
        return response()->json(["status" => "201", "message" => "Successfully updated the role.", "data" => new RoleResource($role)], 201);
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('ROLE_DELETE');
        if (!$access === true) return $access;

        $role = Role::find($id);
        if (!$role) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        
        $role->delete();
        return response()->json(["status" => "200", "message" => "User role has been successfully deleted.", "data" => new RoleResource($role)], 200);
    }
}
