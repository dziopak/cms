<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\NewPasswordRequest;

use App\Events\Users\UserNewPasswordEvent;
use App\Events\Users\UserBlockEvent;
use App\Http\Utilities\ModelUtilities;

use App\User;
use App\Role;
use Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.users.index');
    }
    
    
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        return view('admin.users.create', compact('roles', 'form'));
    }
    
    
    public function store(UsersCreateRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        
        $data = $request->except('avatar');
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        return redirect(route('admin.users.index'));
    }
    

    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.edit', ['user_id' => $id]);
    }


    public function update(UsersEditRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        
        $user = User::findOrFail($id);
        $data = ModelUtilities::makeDirtyRequest($request->file('avatar'), $request->except('avatar'));
        
        $user->update($data);
        return redirect(route('admin.users.index'));
    }

    public function password(NewPasswordRequest $request, $id) {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        $user = User::findOrFail($id);
        
        $user->update(['password' => Hash::make($request->password)]);
        event(new UserNewPasswordEvent($user));
        $request->session()->flash('crud', 'Password of '.$user->name.' has been set successfully.');
        
        return redirect(route('admin.users.index'));
    }

    public function disable($id) {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.disable', ['user_id' => $id]);
    }

    public function block(Request $request, $id) {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        
        $user = User::findOrFail($id);
        $is_active = $request->get('is_active');

        $user->is_active = $is_active;
        $user->save();
        
        event(new UserBlockEvent($user));
        $request->session()->flash('crud', $user->is_active == 1 ? "User ".$user->name." has been unblocked." : "User ".$user->name." has been blocked.");
        
        return redirect(route('admin.users.index'));
    }

    
    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        return view('admin.users.delete', ['user_id' => $id]);
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect(route('admin.users.index'));
    }

    public function mass(Request $request) {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return Redirect::back()->with('error', 'No users were selected.');
        } else {
            switch($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('USER_DELETE');
                    User::whereIn('id', $data['mass_edit'])->delete();
                break;
                
                case 'hide':
                    Auth::user()->hasAccessOrRedirect('USER_EDIT');
                    User::whereIn('id', $data['mass_edit'])->update(['is_active' => 0]);
                break;
                
                case 'show':
                    Auth::user()->hasAccessOrRedirect('USER_EDIT');
                    User::whereIn('id', $data['mass_edit'])->update(['is_active' => 1]);
                break;
                
                case 'role':
                    Auth::user()->hasAccessOrRedirect('USER_EDIT');
                    // TO DO //
                    // SET ROLE ACCESS //
                    User::whereIn('id', $data['mass_edit'])->update(['role_id' => $data['role']]);
                break;
            }
        }
        return redirect(route('admin.users.index'));
    }
}
