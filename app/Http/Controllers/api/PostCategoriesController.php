<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostResource;
use App\Http\Utilities\AuthResponse;
use App\Http\Utilities\CategoryUtilities;

use App\Post;
use App\User;
use App\PostCategory;
use JWTAuth;
use Hook;

class PostCategoriesController extends Controller
{
    
    
    public function index(Request $request)
    {
        return CategoryCollection::collection(PostCategory::orderByDesc('created_at')->paginate(15));
    }

    
    public function posts($id) {
        $category = CategoryCollection::collection(PostCategory::findOrFail($id));
        return ['data' => $category, 'status' => '200'];
    }


    public function store(Request $request)
    {
        $validation = CategoryUtilities::storeValidation($request);
        $access = AuthResponse::hasAccess('CATEGORY_CREATE');
        
        if ($access !== true) return $access;
        if ($validation !== true) return $validation;

        $category = PostCategory::create($request->all());
        return response()->json(["status" => "201", "message" => "Successfully created new category.", "data" => $category], 201);
    }


    public function show($id)
    {
        if (is_numeric($id)) {
            $category = PostCategory::find($id);
        }   else {
            $category = PostCategory::where(['slug' => $id]);
            $category = Hook::get('apiPostCategoriesFindSelector',[$category, $id],function($category, $id){
                return $category;
            });

            $category = $category->first();
        }

        if (!$category) return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        return new CategoryResource($category);
    }


    public function update($id, Request $request) {
        $access = AuthResponse::hasAccess('CATEGORY_UPDATE');
        $validation = CategoryUtilities::updateValidation($request);

        if ($access !== true) return $access; 
        if ($validation !== true) return $validation; 

        $category = PostCategory::find($id);
        if (!$category) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);
        
        $category->update($request->all());
        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $category], 200);
    }


    public function destroy($id) {
        $access = AuthResponse::hasAccess('CATEGORY_DELETE');
        if (!$access === true) return $access;

        $category = PostCategory::find($id);
        if (!$category) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        
        $category->delete();

        $post = Post::where(['category_id' => $id]);
        $post->fire_events = false;
        $post->update(['category_id' => 0]);

        return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $category], 200);
    }
}
