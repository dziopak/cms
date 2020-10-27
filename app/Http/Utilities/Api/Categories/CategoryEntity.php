<?php

namespace App\Http\Utilities\Api\Categories;

use App\Http\Utilities\Api\AuthResponse;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Entities\PostCategory;
use App\Entities\PageCategory;
use Hook;

class CategoryEntity
{

    protected $model;
    private $selector;
    private $tag;

    public function __construct($type)
    {
        $this->tag = $type;

        switch ($type) {
            case 'post':
                $this->model = PostCategory::class;
                $this->selector = 'PostCategories';
                break;

            case 'page':
                $this->model = PageCategory::class;
                $this->selector = 'PageCategories';
                break;
        }
    }


    public function index($request)
    {
        return CategoryCollection::collection($this->model::orderByDesc('created_at')->paginate(15));
    }


    public function store($request)
    {
        $validation = CategoryValidation::storeValidation($request, $this->tag);
        if ($validation !== true) return $validation;

        $category = $this->model::create($request->all());
        return response()->json(["status" => "201", "message" => "Successfully created new category.", "data" => $category], 201);
    }


    public function show($id)
    {
        $category = $this->find($id);

        if (!$category) return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        return new CategoryResource($category);
    }


    public function update($id, $request)
    {
        $validation = CategoryValidation::updateValidation($request, $this->tag);
        if ($validation !== true) return $validation;

        $category = $this->find($id);
        if (!$category) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        $category->update($request->all());
        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $category], 200);
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('CATEGORY_DELETE');
        if (!$access === true) return $access;

        $category = $this->find($id);
        if (!$category) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);

        $category->delete();
        return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $category], 200);
    }


    public function find($id)
    {
        if (is_numeric($id)) {
            $category = $this->model::find($id);
        } else {
            $category = $this->model::where(['slug' => $id]);
            $category = Hook::get('api' . $this->selector . 'FindSelector', [$category, $id], function ($category, $id) {
                return $category;
            });
        }

        return $category->first();
    }
}
