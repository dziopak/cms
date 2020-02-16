<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Role;
use App\File;
use App\Log;
use Auth;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        $role = new Role;
        $roles = $role->get_all_roles();
        return view('admin.users.create', compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if ($avatar = $request->file('avatar')) {
            $name = time(). '_' .$avatar->getClientOriginalName();
            $avatar->move('images/avatars', $name);
            
            $photo = File::create(['path' => 'avatars/'.$name, 'type' => '1']);
            $data['avatar'] = $photo->id;
        }
        $created_user_id = User::create($data)->id;

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $created_user_id,
            'target_name' => $data['name'],
            'type' => 'USER',
            'crud_action' => '1',
            'message' => 'created new user'
        ];
        Log::create($log_data);

        return redirect(route('admin.users.index'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $request->all();
        // return view('admin.users.create');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        $user = User::findOrFail($id);
        $logs = $user->logs()->take(5)->orderBy('created_at', 'desc')->get();

        $role = new Role;
        $roles = $role->get_all_roles();
        return view('admin.users.edit', compact('user', 'roles', 'logs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        $role = new Role;
        
        $user = User::findOrFail($id);
        $data = $request->all();
        
        $logs = $user->logs()->take(5)->orderBy('created_at')->get();
        $roles = $role->get_all_roles();
        
        if ($avatar = $request->file('avatar')) {
            if ($user->avatar != "1") {
                unlink(public_path() . '/images/'.$user->photo->path);
                $user->photo()->delete();
            }
            $name = time(). '_' .$avatar->getClientOriginalName();
            $avatar->move('images/avatars', $name);
            
            $photo = File::create(['path' => 'avatars/'.$name, 'type' => '1']);
            $data['avatar'] = $photo->id;
        }

        $user->update($data);
        $request->session()->flash('crud', 'Account data of '.$user->name.' has been updated successfully.');
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $user->id,
            'target_name' => $user->name,
            'type' => 'USER',
            'crud_action' => '2',
            'message' => 'modified user'
        ];
        Log::create($log_data);

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
        
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $user->id,
            'target_name' => $user->name,
            'type' => 'USER',
            'crud_action' => '2',
            'message' => $is_active == 1 ? 'unblocked user' : 'blocked user'
        ];
        Log::create($log_data);
        $request->session()->flash('crud', $is_active == 1 ? "User ".$user->name." has been unblocked." : "User ".$user->name." has been blocked.");
        return redirect(route('admin.users.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        $user = User::findOrFail($id);
        $logs = $user->account_logs()->take(5)->orderBy('created_at', 'desc')->get();

        return view('admin.users.delete', compact('user', 'logs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        $user = User::findOrFail($id);
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => '0',
            'target_name' => $user->name,
            'type' => 'USER',
            'crud_action' => '3',
            'message' => 'deleted account of '
        ];
        Log::create($log_data);
        Session::flash('crud', "Account of ".$user->name." was deleted successfully.");
        
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}
