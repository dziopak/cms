<?php

namespace App\Http\Utilities\Api\Pages;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;

use Hook;

class PageValidation
{


    static function storeValidation($request)
    {
        $access = AuthResponse::hasAccess('PAGE_CREATE');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) {
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        }

        return true;
    }


    static function updateValidation($request)
    {
        $access = AuthResponse::hasAccess('PAGE_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'string|max:255',
            'excerpt' => 'string|max:255',
            'slug' => 'string|max:255|unique:pages',
            'content' => 'string'
        ];

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) {
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        }

        return true;
    }
}
