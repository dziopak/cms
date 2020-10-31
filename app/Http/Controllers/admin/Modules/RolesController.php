<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Admin\Modules\Roles\RoleEntity;
use Illuminate\Http\Request;

use App\Entities\Role;
use Auth;

class RolesController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.roles.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create');
    }


    public function store(Request $request)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return RoleEntity::store($request);
    }


    public function edit(Role $role)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        return view('admin.roles.edit', compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        return RoleEntity::update($role, $request);
    }


    public function delete(Role $role)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        return view('admin.roles.delete', compact('role'));
    }


    public function duplicate(Role $role)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create', compact('role'));
    }


    public function destroy(Role $role)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        return RoleEntity::destroy($role);
    }
}
