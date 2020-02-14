<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;
use App\File;
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
    public function store(UsersRequest $request)
    {
        if ($request->password === $request->repeat_password) {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            if ($avatar = $request->file('avatar')) {
                $name = time(). '_' .$avatar->getClientOriginalName();
                $avatar->move('images/avatars', $name);
                
                $avatar = File::create(['path' => $name, 'type' => '1'])->id;
                $data['avatar'] = $avatar;
            }
            User::create($data);
            return redirect(route('admin.users.index'));
        } else {
            $role = new Role;
            $roles = $role->get_all_roles();
            return view('admin.users.create', compact("roles"));
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $request->all();
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
    public function update(Request $request, $id)
    {
        //
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
