<?php

namespace App\Http\Controllers\Api;

use App\Http\Utilities\Api\v1\Users\UserAuthentication;
use App\Http\Controllers\Controller;
use App\Http\Utilities\Api\AuthResponse;
use Illuminate\Http\Request;
use App\Entities\User;
use JWTAuth;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return User::apiIndex($request);
    }

    public function show($id)
    {
        return User::findOrFail($id)->apiShow();
    }

    public function store(Request $request)
    {
        return User::apiStore($request);
    }

    public function update(Request $request, $id)
    {
        return User::findOrfail($id)->update($request);
    }

    public function destroy($id)
    {
        return User::findOrFail($id)->destroy();
    }

    public function authenticate(Request $request)
    {
        return UserAuthentication::authenticateCredentials($request->only('email', 'password'));
    }

    public function register(Request $request)
    {
        return UserAuthentication::register($request);
    }

    public function getAuthenticatedUser()
    {
        return AuthResponse::authAndRespond(JWTAuth::parseToken()->authenticate());
    }
}
