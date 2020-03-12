<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Utilities\AuthResponse;
use App\Http\Utilities\UserUtilities;
use App\Http\Resources\UserResource;
use App\User;
use JWTAuth;
use Hook;

class UsersController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return UserUtilities::authenticateCredentials($credentials);
    }


    public function register(Request $request)
    {
        $validation = UserUtilities::registerValidation($request);
        if ($validation !== true) return $validation;

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user['token'] = $token = JWTAuth::fromUser($user); 
        return response()->json(["message" => "Successfully registered new user account.", "user" => $user, "status" => 201], 201);
    }


    public function getAuthenticatedUser()
    {
        $response = AuthResponse::authAndRespond(JWTAuth::parseToken()->authenticate());
        return $response;
    }


    public function index() {
        return UserResource::collection(User::orderBy('id')->paginate(15));
    }


    public function show($id)
    {
        $user = User::find($id);
        return $user ? new UserResource($user) : response()->json(["status" => "404", "message" => "User doesn't exist."], 404);
    }


    public function store(Request $request)
    {
        $validation = UserUtilities::storeValidation($request);
        if ($validation !== true) return $validation;

        $data = $request->except(['avatar', 'password', 'password_repeat']);
        $data['password'] = Hash::make($request->get('password'));

        $user = new UserResource(User::create($data));
        return response()->json(["status" => "201", "message" => "Successfully created new user account.", "data" => compact('user')], 201);
        
    }


    public function update(Request $request, $id)
    {
        $validation = UserUtilities::updateValidation($request);
        if ($validation !== true) return $validation;
        
        $user = User::find($id);
        if (!$user) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);    
        
        $data = $request->except('avatar', 'password', 'repeat_password');
        $user->update($data);

        return response()->json(["status" => "201", "message" => "Successfully updated user account.", "data" => new UserResource($user)], 201);
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('USER_DELETE');
        if (!$access === true) return $access;

        $user = User::find($id);
        if (!$user) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        
        $user->delete();
        return response()->json(["status" => "200", "message" => "User has been successfully deleted.", "data" => new UserResource($user)], 200);
    }
}
