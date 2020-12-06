<?php

namespace App\Http\Utilities\Api\v1\Categories;

use App\Exceptions\TokenVerificationException;
use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;
use Lcobucci\JWT\Token;

class CategoryValidation
{
    static function store($item)
    {
        $item['slug'] = generateSlug($item['name']);

        $validationFields = [
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories'
        ];

        $validator = Validator::make($item, $validationFields);
        if ($validator->fails()) {
            return [
                $item,
                'errors' => $validator->errors()
            ];
        }

        return true;
    }

    static function update($item)
    {
        if (!empty($item['slug'])) unset($item['slug']);
        if (!empty($item['name'])) $item['slug'] = generateSlug($item['name']);

        $validationFields = [
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:categories',
            'description' => 'string|max:255',
        ];

        $validator = Validator::make($item, $validationFields);
        if ($validator->fails()) {
            return [
                'item' => $item,
                'errors' => $validator->errors()
            ];
        }

        return true;
    }

    static function validate($items, $action)
    {
        $errors = [];

        foreach ($items as $item) {
            $validation = CategoryValidation::$action($item);
            if ($validation !== true) $errors[] = $validation;
        }

        if (!empty($errors)) throw new ValidationException($errors);
        return true;
    }
}
