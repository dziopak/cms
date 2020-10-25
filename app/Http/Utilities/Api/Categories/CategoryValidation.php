<?php

namespace App\Http\Utilities\Api\Categories;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;
use App\Models\PostCategory;
use App\Models\PageCategory;

use Hook;

class CategoryValidation
{

    static function storeValidation($request, $type)
    {
        $access = AuthResponse::hasAccess('CATEGORY_CREATE');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:' . $type . '_categories'
        ];

        if ($type === 'post') {
            $validationFields = Hook::get('apiPostCategoriesStoreValidation', [$validationFields], function ($validationFields) {
                return $validationFields;
            });
        } else if ($type === 'page') {
            $validationFields = Hook::get('apiPageCategoriesStoreValidation', [$validationFields], function ($validationFields) {
                return $validationFields;
            });
        }

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);

        return true;
    }


    static function updateValidation($request, $type)
    {
        $access = AuthResponse::hasAccess('CATEGORY_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:' . $type . '_categories',
            'description' => 'string|max:255',
        ];

        if ($type === 'post') {
            $validationFields = Hook::get('apiPostCategoriesUpdateValidation', [$validationFields], function ($validationFields) {
                return $validationFields;
            });
        } else if ($type === 'page') {
            $validationFields = Hook::get('apiPageCategoriesUpdateValidation', [$validationFields], function ($validationFields) {
                return $validationFields;
            });
        }

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) return ["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()];

        return true;
    }
}
