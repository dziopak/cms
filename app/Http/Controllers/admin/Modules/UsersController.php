<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Modules\Users\UsersCreateRequest;
use App\Http\Requests\Admin\Modules\Users\NewPasswordRequest;
use App\Http\Requests\Admin\Modules\Users\UsersEditRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\User;


class UsersController extends Controller
{
    public function index(Request $request)
    {
        return User::webIndex($request);
    }

    public function create()
    {
        return User::webCreate();
    }

    public function store(UsersCreateRequest $request)
    {
        return User::webStore($request);
    }

    public function edit($user)
    {
        return User::findOrFail($user)->webEdit();
    }

    public function update(UsersEditRequest $request, $user)
    {
        return User::findOrFail($user)->webUpdate($request);
    }

    public function password(NewPasswordRequest $request, $user)
    {
        return User::findOrFail($user)->setPassword($request);
    }

    public function disable($user)
    {
        return User::findOrFail($user)->disable();
    }

    public function block(Request $request, $user)
    {
        return User::findOrFail($user)->block($request);
    }

    public function destroy($user)
    {
        return User::findOrFail($user)->webDestroy();
    }

    public function mass(Request $request)
    {
        return User::mass($request->all());
    }
}
