<?php

namespace App\Http\Utilities\Api\Categories;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;

class CategoryValidation
{

    static function storeValidation($request)
    {
        $access = AuthResponse::hasAccess('CATEGORY_CREATE');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories'
        ];


        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);

        return true;
    }


    static function updateValidation($request)
    {
        $access = AuthResponse::hasAccess('CATEGORY_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:categories',
            'description' => 'string|max:255',
        ];

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return ["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()];

        return true;
    }
}
