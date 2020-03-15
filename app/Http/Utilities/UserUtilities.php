<?php

    namespace App\Http\Utilities;

    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Http\Utilities\AuthResponse;

    use App\User;
    use JWTAuth;
    use Hook;

    class UserUtilities {
        static function register($request) {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
    
            $user['token'] = JWTAuth::fromUser($user);
            return $user; 
        }

        static function create($request) {
            $data = $request->except(['avatar', 'password', 'password_repeat']);
            $data['password'] = Hash::make($request->get('password'));

            $user = new UserResource(User::create($data));
        }

        static function find($id) {
            is_numeric($id) ? $user = User::find($id) : $user = User::where(['email' => $id])->first();
            return $user;
        }

        static function authenticateCredentials($credentials) {
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['message' => 'Invalid login credentials.', 'status' => '400'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['Message' => 'Error while creating the token', 'status' => '500'], 500);
            }
    
            return response()->json(['token' => $token, 'status' => 200]);
        }


        static function storeValidation($request) {
            $access = AuthResponse::hasAccess();
            if ($access !== true) return $access;
            
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
            return true;
        }


        static function updateValidation($request) {
            $access = AuthResponse::hasAccess('USER_EDIT');
            if ($access !== true) return $access;

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
    
            if($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
            return true;
        }

        static function registerValidation($request) {
            $validationFields = [
                'name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ];
            $validationFields = Hook::get('apiUserRegisterValidation',[$validationFields],function($validationFields){
                return $validationFields;
            });

            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()) return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors()->toJson(), 'status' => '400'], 400);

            return true;
        }
    }