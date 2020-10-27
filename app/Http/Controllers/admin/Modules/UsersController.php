<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Utilities\Admin\Modules\Users\UserEntity;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\UsersEditRequest;

use Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        return view('admin.users.create');
    }


    public function store(UsersCreateRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        return UserEntity::store($request->all());
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.edit', ['user_id' => $id]);
    }


    public function update(UsersEditRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserEntity::update($id, $request);
    }


    public function password(NewPasswordRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserEntity::setUserPassword($id, $request);
    }


    public function disable($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.disable', ['user_id' => $id]);
    }


    public function block(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserEntity::blockUser($id, $request);
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        return UserEntity::destroy($id);
    }


    public function mass(Request $request)
    {
        return UserEntity::massAction($request->all());
    }
}
