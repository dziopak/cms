<?php

namespace App\Http\Utilities\Api\v1\Pages;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;


class PageValidation
{
    static function store($item)
    {
        $item['slug'] = generateSlug($item['name']);

        $validationFields = [
            'name' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'required|string'
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

    static function update($item)
    {
        if (!empty($item['slug'])) unset($item['slug']);
        if (!empty($item['name'])) $item['slug'] = generateSlug($item['name']);

        $validationFields = [
            'name' => 'string|max:255',
            'excerpt' => 'string|max:255',
            'slug' => 'unique:pages',
            'content' => 'string'
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

    static function validate($items, $action, $access = null)
    {
        $errors = [];
        $access = AuthResponse::hasAccessAndRespond($access);

        if ($access !== true) return $access;

        foreach ($items as $item) {
            $validation = PageValidation::$action($item);
            if ($validation !== true) $errors[] = $validation;
        }

        if (empty($errors)) return true;

        return [
            "message" => "There were errors during the validation.",
            "validation" => $errors
        ];
    }
}
