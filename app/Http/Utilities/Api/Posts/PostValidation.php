<?php

namespace App\Http\Utilities\Api\Posts;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;

use Hook;

class PostValidation
{
    static function storeValidation($request)
    {
        $access = AuthResponse::hasAccess('POST_CREATE');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'content' => 'required|string'
        ];
        $validationFields = Hook::get('apiPostsStoreValidation', [$validationFields], function ($validationFields) {
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) {
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        }

        return true;
    }

    static function updateValidation($request)
    {
        $access = AuthResponse::hasAccess('POST_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'string|max:255',
            'excerpt' => 'string|max:255',
            'slug' => 'string|max:255|unique:posts',
            'content' => 'string'
        ];
        $validationFields = Hook::get('apiPostsUpdateValidation', [$validationFields], function ($validationFields) {
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) {
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        }

        return true;
    }
}
