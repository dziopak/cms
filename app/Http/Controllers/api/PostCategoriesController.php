<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\AuthResponse;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Utilities\CategoryUtilities;
use App\PostCategory;


class PostCategoriesController extends Controller
{

    public function index(Request $request)
    {
        return CategoryCollection::collection(PostCategory::orderByDesc('created_at')->paginate(15));
    }


    public function posts($id)
    {
        $category = CategoryCollection::collection(PostCategory::find($id));
        return ['data' => $category, 'status' => '200'];
    }


    public function store(Request $request)
    {
        $validation = CategoryUtilities::storeValidation($request, 'post');
        if ($validation !== true) return $validation;

        $category = PostCategory::create($request->all());
        return response()->json(["status" => "201", "message" => "Successfully created new category.", "data" => $category], 201);
    }


    public function show($id)
    {
        $category = CategoryUtilities::find($id, 'post');

        if (!$category) return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        return new CategoryResource($category);
    }


    public function update($id, Request $request)
    {
        $validation = CategoryUtilities::updateValidation($request, 'post');
        if ($validation !== true) return $validation;

        $category = CategoryUtilities::find($id, 'post');
        if (!$category) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        $category->update($request->all());
        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $category], 200);
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('CATEGORY_DELETE');
        if (!$access === true) return $access;

        $category = CategoryUtilities::find($id, 'post');
        if (!$category) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);

        $category->delete();
        return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $category], 200);
    }
}
