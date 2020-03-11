<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\AuthResponse;

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
        $validationFields = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'access' => 'array'
        ];

        $validationFields = Hook::get('apiRolesStoreValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });
        $validator = Validator::make($request->all(), $validationFields);

        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess('ROLE_CREATE');
            if ($access !== true) return $access;

            $data = $request->except('access');
            $data['access'] = serialize($request->get('access'));

            $role = new RoleResource(Role::create($data));
            return response()->json(["status" => "201", "message" => "Successfully created new role.", "data" => compact('role')], 201);
        }
    }


    public function update(Request $request, $id)
    {
        $validationFields = [
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'access' => 'array'
        ];
        $validationFields = Hook::get('apiRoleUpdateValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);

        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess('ROLE_EDIT');
            if ($access !== true) return $access;
            $role = Role::find($id);
            
            if ($role) {
                $data = $request->except('access');
                $data['access'] = serialize($request->get('access'));
                $role->update($data);
    
                return response()->json(["status" => "201", "message" => "Successfully updated the role.", "data" => new RoleResource($role)], 201);
            } else {
                return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);    
            }
        }
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('ROLE_DELETE');
        if (!$access === true) return $access;

        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return response()->json(["status" => "200", "message" => "User role has been successfully deleted.", "data" => new RoleResource($role)], 200);
        } else {
            return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        }
    }
}
