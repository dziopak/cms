<?php

namespace App\Http\Controllers\Api;

use App\Http\Utilities\Api\Roles\RoleEntity;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use App\Entities\Role;


class RolesController extends Controller
{


    public function index()
    {
        return RoleResource::collection(Role::orderBy('id')->paginate(15));
    }


    public function show($id)
    {
        return RoleEntity::show($id);
    }


    public function store(Request $request)
    {
        return RoleEntity::store($request);
    }


    public function update(Request $request, $id)
    {
        return RoleEntity::update($request, $id);
    }


    public function destroy($id)
    {
        return RoleEntity::destroy($id);
    }
}
