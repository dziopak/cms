<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Role;

class RolesController extends Controller
{

    public function index(Request $request)
    {
        return Role::webIndex($request);
    }

    public function create()
    {
        return Role::webCreate();
    }

    public function store(Request $request)
    {
        return Role::webStore($request);
    }

    public function edit($role)
    {
        return Role::findOrFail($role)->webEdit();
    }

    public function update(Request $request, $role)
    {
        return Role::findOrFail($role)->webUpdate($request);
    }

    public function duplicate($role)
    {
        return Role::findOrFail($role)->duplicate();
    }

    public function destroy($role)
    {
        return Role::findOrFail($role)->webDestroy();
    }
}
