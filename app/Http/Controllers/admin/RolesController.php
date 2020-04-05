<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Utilities\RoleUtilities;
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

        $data = $request->all();
        if (!empty($data['access'])) $data['access'] = RoleUtilities::serializeAccess($data['access']);

        Role::create($data);
        $request->session()->flash('crud', 'Created ' . $data['name'] . ' role successfully.');

        return redirect(route('admin.users.roles.index'));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        return view('admin.roles.edit', ['role_id' => $id]);
    }


    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');

        $role = Role::findOrFail($id);
        $data = $request->all();

        $data['access'] = RoleUtilities::serializeAccess($data['access']);

        $role->update($data);
        $request->session()->flash('crud', 'Updated ' . $data['name'] . ' role successfully.');

        return redirect(route('admin.users.roles.index'));
    }

    public function delete($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        return view('admin.roles.delete', ['role' => Role::findOrFail($id)]);
    }

    public function duplicate($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');

        $role = Role::findOrFail($id);
        $role->access = RoleUtilities::unserializeAccess($role->access);

        return view('admin.roles.create', compact('role'));
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();
        Session::flash('crud', 'Role ' . $role->name . ' has been deleted successfully.');

        return redirect(route('admin.users.roles.index'));
    }
}
