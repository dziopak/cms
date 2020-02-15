<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Log;
use Illuminate\Support\Facades\Session;
use Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        $data = $request->all();
        $access = [];
        foreach($data['access'] as $key => $row) {
            if ($row === '1') {
                array_push($access, $key);
            }
        }
        $data['access'] = serialize($access);
        $id = Role::create($data)->id;
        $request->session()->flash('crud', 'Created '.$data['name'].' role successfully.');
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $id,
            'target_name' => $data['name'],
            'type' => 'ROLE',
            'crud_action' => '1',
            'message' => 'created access role'
        ];
        Log::create($log_data);
        return redirect(route('admin.roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $id,
            'target_name' => $data['name'],
            'type' => 'ROLE',
            'crud_action' => '2',
            'message' => 'updated access role'
        ];
        
        Log::create($log_data);
        $request->session()->flash('crud', 'Updated '.$data['name'].' role successfully.');
        
        $role->update($data);
        return redirect(route('admin.roles.index'));
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
