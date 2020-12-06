<?php

namespace App\Http\Utilities\Api\v1\Categories;

use App\Exceptions\NotExistingException;
use App\Exceptions\TokenVerificationException;
use App\Exceptions\ValidationException;
use App\Http\Utilities\Api\AuthResponse;
use App\Http\Resources\CategoryResource;
use App\Http\Utilities\Api\ApiResponse;
use App\Interfaces\ApiEntity;

class CategoryEntity extends ApiResponse implements ApiEntity
{
    private $item;

    public function __construct($item)
    {
        try {
            if (exists($item)) $this->item = $item;
        } catch (NotExistingException $e) {
            return $e->response();
        }
    }


    public function show()
    {
        return new CategoryResource($this->item);
    }


    static function store($request)
    {
        try {
            AuthResponse::checkAccess('CATEGORY_CREATE');

            $item = CategoryActions::prepareToStore($request->all());
            CategoryValidation::validate([$item], 'store');
            $category = CategoryActions::create([$item]);

            return self::response("Successfully created new category.", $category);
        } catch (ValidationException | TokenVerificationException $e) {
            return $e->response();
        }
    }


    public function update($request)
    {
        try {
            AuthResponse::checkAccess('CATEGORY_EDIT');

            $data = CategoryActions::prepareToUpdate($request->all());
            CategoryValidation::validate([$data], 'update');
            $this->item->update($data);

            return $this->response("Successfully updated category.", 201, $this->item->fresh());
        } catch (ValidationException $e) {
            return $e->response();
        }
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccessAndRespond('CATEGORY_DELTE');
        if (!$access === true) return $access;
        $this->item->delete();

        return $this->response("Category has been successfully deleted", $this->item);
    }
}
