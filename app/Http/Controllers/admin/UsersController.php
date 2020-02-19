<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\NewPasswordRequest;

use App\Events\Users\UserCreateEvent;
use App\Events\Users\UserUpdateEvent;
use App\Events\Users\UserDestroyEvent;
use App\Events\Users\UserNewPasswordEvent;
use App\Events\Users\UserBlockEvent;

use App\User;
use App\Role;
use Auth;

class UsersController extends Controller
{
    
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
    
    
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        
        $role = new Role;
        $roles = $role->get_all_roles();
        
        return view('admin.users.create', compact('roles'));
    }
    
    
    public function store(UsersCreateRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        
        $data = $request->except('avatar');
        $data['password'] = Hash::make($request->password);
        $avatar = $request->file('avatar');

        $user = User::create($data);
        event(new UserCreateEvent($user, $avatar));
        $request->session()->flash('crud', 'User '.$user->name.' has been created successfully.');

        return redirect(route('admin.users.index'));
    }
    

    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        $user = User::findOrFail($id);
        $logs = $user->logs()->take(5)->orderBy('created_at', 'desc')->get();

        $role = new Role;
        $roles = $role->get_all_roles();
        return view('admin.users.edit', compact('user', 'roles', 'logs'));
    }


    public function update(UsersEditRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        
        $role = new Role;

        $user = User::findOrFail($id);
        $roles = $role->get_all_roles();
        $data = $request->except('avatar');
        $avatar = $request->file('avatar');
        
        $user->update($data);
        event(new UserUpdateEvent($user, $avatar));
        $request->session()->flash('crud', 'Account data of '.$user->name.' has been updated successfully.');
        
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
        
        $user = User::findOrFail($id);
        $logs = $user->account_logs()->take(5)->orderBy('created_at', 'desc')->get();

        return view('admin.users.disable', compact('user', 'logs'));
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
        
        $user = User::findOrFail($id);
        $logs = $user->account_logs()->take(5)->orderBy('created_at', 'desc')->get();

        return view('admin.users.delete', compact('user', 'logs'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        
        $user = User::findOrFail($id);
        $user->delete();
        event(new UserDestroyEvent($user));
        Session::flash('crud', "Account of ".$user->name." was deleted successfully.");
        
        return redirect(route('admin.users.index'));
    }
}
