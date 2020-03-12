<?php

    namespace App\Http\Utilities;

    use Illuminate\Support\Facades\Validator;
    
    use Hook;

    class RoleUtilities {
        static function storeValidation($request) {
            $validationFields = [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'access' => 'array'
            ];
    
            $validationFields = Hook::get('apiRolesStoreValidation',[$validationFields],function($validationFields){
                return $validationFields;
            });
            
            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);         
            
            return true;
        }

        static function updateValidation($request) {
            $validationFields = [
                'name' => 'string|max:255',
                'description' => 'string|max:255',
                'access' => 'array'
            ];
            $validationFields = Hook::get('apiRoleUpdateValidation',[$validationFields],function($validationFields){
                return $validationFields;
            });
    
            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
            
            return true;
        }
    }