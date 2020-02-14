<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Hash;

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
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if ($avatar = $request->file('avatar')) {
            $name = time(). '_' .$avatar->getClientOriginalName();
            $avatar->move('images/avatars', $name);
            
            $photo = File::create(['path' => $name, 'type' => '1']);
            $data['avatar'] = $photo->id;
        }
        $created_user_id = User::create($data)->id;

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $created_user_id,
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
        $user = User::findOrFail($id);
        $logs = $user->account_logs()->take(5)->orderBy('created_at', 'desc')->get();

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
        $role = new Role;
        
        $user = User::findOrFail($id);
        $data = $request->all();
        
        $logs = $user->logs()->take(5)->orderBy('created_at')->get();
        $roles = $role->get_all_roles();
        
        if ($avatar = $request->file('avatar')) {
            $name = time(). '_' .$avatar->getClientOriginalName();
            $avatar->move('images/avatars', $name);
            
            $photo = File::create(['path' => $name, 'type' => '1']);
            $data['avatar'] = $photo->id;
        }

        $user->update($data);
        
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $user->id,
            'type' => 'USER',
            'crud_action' => '2',
            'message' => 'modified user'
        ];
        Log::create($log_data);

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
