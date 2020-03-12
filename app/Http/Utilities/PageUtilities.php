<?php

    namespace App\Http\Utilities;

    use Illuminate\Support\Facades\Validator;
    use Hook;

    class PageUtilities {
        static function storeValidation($request) {
            $validationFields = [
                'name' => 'required|string|max:255',
                'excerpt' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:pages',
                'content' => 'required|string'
            ];
            $validationFields = Hook::get('apiPagesStoreValidation',[$validationFields],function($validationFields){
                return $validationFields;
            });

            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()){
                return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
            }

            return true;
        }

        static function updateValidation($request) {
            $validationFields = [
                'name' => 'string|max:255',
                'excerpt' => 'string|max:255',
                'slug' => 'string|max:255|unique:pages',
                'content' => 'string'
            ];
            $validationFields = Hook::get('apiPagesUpdateValidation',[$validationFields],function($validationFields){
                return $validationFields;
            });
    
            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()){
                return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
            }

            return true;
        }
    }