<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Admin\RoleUtilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Role;
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
        return RoleUtilities::store($request);
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        return view('admin.roles.edit', ['role_id' => $id]);
    }


    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        return RoleUtilities::update($id, $request);
    }


    public function delete($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        return view('admin.roles.delete', ['role' => Role::findOrFail($id)]);
    }


    public function duplicate($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create', ['role_id' => $id]);
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        return RoleUtilities::destroy($id);
    }
}
