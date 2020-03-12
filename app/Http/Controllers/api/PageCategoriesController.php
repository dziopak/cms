<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Utilities\AuthResponse;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Utilities\CategoryUtilities;

use App\Page;
use App\PageCategory;

use JWTAuth;
use Hook;

class PageCategoriesController extends Controller
{
    
    public function index(Request $request)
    {
        return CategoryCollection::collection(PageCategory::orderByDesc('created_at')->paginate(15));
    }


    public function pages($id) {
        $category = CategoryCollection::collection(PageCategory::findOrFail($id));
        return ['data' => $category, 'status' => '200'];
    }


    public function store(Request $request)
    {
        $validation = CategoryUtilities::storeValidation($request, 'page');
        if ($validation !== true) return $validation;

        $category = PageCategory::create($request->all());
        return response()->json(["status" => "201", "message" => "Successfully created new category.", "data" => $category], 201);
    }


    public function show($id)
    {
        if (is_numeric($id)) {
            $category = PageCategory::find($id);
        }   else {
            $category = PageCategory::where(['slug' => $id]);
            $category = Hook::get('apiPageCategoriesFindSelector',[$category, $id],function($category, $id){
                return $category;
            });

            $category = $category->first();
        }

        if (!$category) return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        return new CategoryResource($category);
    }


    public function update($id, Request $request) {
        $validation = CategoryUtilities::updateValidation($request, 'page');
        if ($validation !== true) return $validation; 

        $category = PageCategory::find($id);
        if (!$category) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);
        
        $category->update($request->all());
        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $category], 200);
    }


    public function destroy($id) {
        $access = AuthResponse::hasAccess('CATEGORY_DELETE');
        if (!$access === true) return $access;

        $category = PageCategory::find($id);
        if (!$category) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        
        $category->delete();
        return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $category], 200);
    }
}
