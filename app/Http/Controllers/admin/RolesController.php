<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Events\Roles\RoleCreateEvent;
use App\Events\Roles\RoleUpdateEvent;
use App\Events\Roles\RoleDestroyEvent;

use App\Role;
use App\Log;
use Auth;

class RolesController extends Controller
{
    
    public function index(Request $request)
    {
        
        $roles = Role::filter($request)->paginate(15);
        return view('admin.roles.index', compact('roles'));
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
        $access = [];
        
        if (!empty($data['access'])) {
            foreach($data['access'] as $key => $row) {
                if ($row === '1') {
                    array_push($access, $key);
                }
            }
        }
        $data['access'] = serialize($access);
        
        $role = Role::create($data);
        event(new RoleCreateEvent($role));
        $request->session()->flash('crud', 'Created '.$data['name'].' role successfully.');
        
        return redirect(route('admin.users.roles.index'));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        $role = Role::findOrFail($id);
        $access = [];
        foreach(unserialize($role->access) as $role_access) {
            $access[$role_access] = 1;
        }
        $role->access = $access;
        return view('admin.roles.edit', compact('role'));
    }

    
    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        
        $role = Role::findOrFail($id);
        $data = $request->all();

        $access = [];
        foreach($data['access'] as $key => $row) {
            if ($row === '1') {
                array_push($access, $key);
            }
        }
        $data['access'] = serialize($access);
        
        $role->update($data);
        event(new RoleUpdateEvent($role));
        $request->session()->flash('crud', 'Updated '.$data['name'].' role successfully.');
        
        return redirect(route('admin.users.roles.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        $role = Role::findOrFail($id);

        return view('admin.roles.delete', compact('role'));
    }

    public function duplicate($id) {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        $role = Role::findOrFail($id);
        
        $access = [];
        foreach(unserialize($role->access) as $role_access) {
            $access[$role_access] = 1;
        }
        $role->access = $access;
        
        return view('admin.roles.create', compact('role'));
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        $role->delete();
        event(new RoleDestroyEvent($role));
        Session::flash('crud', 'Role '.$role->name.' has been deleted successfully.');

        return redirect(route('admin.users.roles.index'));
    }
}
