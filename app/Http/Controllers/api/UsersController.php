<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Utilities\AuthResponse;
use App\Http\Resources\UserResource;
use App\User;
use JWTAuth;
use Hook;

class UsersController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid login credentials.', 'status' => '400'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['Message' => 'Error while creating the token', 'status' => '500'], 500);
        }

        return response()->json(['token' => $token, 'status' => 200]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors()->toJson(), 'status' => '400'], 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user['token'] = $token = JWTAuth::fromUser($user);
         
        return response()->json($user, 201);
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
        $validationFields = [
            'name' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'role_id' => 'required|numeric',
            'password' => 'required|min:8',
            'repeat_password' => 'required'
        ];
        $validationFields = Hook::get('apiUserStoreValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        $validator->after(function ($validator) use ($request) {
            if ($request->get('password') !== $request->get('repeat_password')) {
                $validator->errors()->add('repeat_password', 'Passwords do not match.');
            }
        });

        if($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        
        $access = AuthResponse::hasAccess();
        if ($access !== true) return $access;

        $data = $request->except(['avatar', 'password', 'password_repeat']);
        $data['password'] = Hash::make($request->get('password'));

        $user = new UserResource(User::create($data));
        return response()->json(["status" => "201", "message" => "Successfully created new user account.", "data" => compact('user')], 201);
        
    }


    public function update(Request $request, $id)
    {
        $validationFields = [
            'name' => 'unique:users',
            'email' => 'email|unique:users',
            'role_id' => 'numeric',
            'password' => 'string|min:8'
        ];
        $validationFields = Hook::get('apiUserUpdateValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        $validator->after(function ($validator) use ($request) {
            if ($request->get('password') !== $request->get('repeat_password')) {
                $validator->errors()->add('repeat_password', 'Passwords do not match.');
            }
        });

        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        }

        $access = AuthResponse::hasAccess('USER_UPDATE');
        if ($access !== true) return $access;
        
        $user = User::find($id);
        
        if ($user) {
            $data = $request->except('avatar', 'password', 'repeat_password');
            $user->update($data);

            return response()->json(["status" => "201", "message" => "Successfully updated user account.", "data" => new UserResource($user)], 201);
        } else {
            return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);    
        }
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('USER_DELETE');
        if (!$access === true) return $access;

        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(["status" => "200", "message" => "User has been successfully deleted.", "data" => new UserResource($user)], 200);
        } else {
            return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        }
    }
}
