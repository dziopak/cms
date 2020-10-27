<?php

namespace App\Http\Controllers\Api;

use App\Http\Utilities\Api\Users\UserAuthentication;
use App\Http\Utilities\Api\Users\UserEntity;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Http\Utilities\Api\AuthResponse;
use Illuminate\Http\Request;
use App\Entities\User;
use JWTAuth;

class UsersController extends Controller
{


    public function index()
    {
        return UserResource::collection(User::orderBy('id')->paginate(15));
    }


    public function show($id)
    {
        return UserEntity::show($id);
    }


    public function store(Request $request)
    {
        return UserEntity::store($request);
    }


    public function update(Request $request, $id)
    {
        return UserEntity::update($request, $id);
    }


    public function destroy($id)
    {
        return UserEntity::destroy($id);
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
