<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Utilities\Admin\Modules\Users\UserEntity;
use App\Http\Requests\Admin\Modules\Users\UsersCreateRequest;
use App\Http\Requests\Admin\Modules\Users\NewPasswordRequest;
use App\Http\Requests\Admin\Modules\Users\UsersEditRequest;
use App\Entities\User;

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


    public function edit(User $user)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.edit', compact('user'));
    }


    public function update(UsersEditRequest $request, User $user)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserEntity::update($user, $request);
    }


    public function password(NewPasswordRequest $request, User $user)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserEntity::setUserPassword($user, $request);
    }


    public function disable(User $user)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.disable', ['user' => $user]);
    }


    public function block(Request $request, User $user)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserEntity::block($user, $request);
    }


    public function destroy(User $user)
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        return UserEntity::destroy($user);
    }


    public function mass(Request $request)
    {
        return UserEntity::massAction($request->all());
    }
}
