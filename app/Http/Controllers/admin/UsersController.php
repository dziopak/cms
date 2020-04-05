<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\NewPasswordRequest;

use App\Http\Utilities\Admin\UserUtilities;
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
        return UserUtilities::store($request);
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.edit', ['user_id' => $id]);
    }


    public function update(UsersEditRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserUtilities::update($id, $request);
    }

    public function password(NewPasswordRequest $request, $id) {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserUtilities::setPassword($id, $request);
    }

    public function disable($id) {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.disable', ['user_id' => $id]);
    }


    public function block(Request $request, $id) {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return UserUtilities::blockUser($id, $request);
    }


    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        return view('admin.users.delete', ['user_id' => $id]);
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        return UserUtilities::destroy($id);
    }

    public function mass(Request $request) {
        return UserUtilities::massAction($request);
    }
}
