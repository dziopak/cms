<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostResource;
use App\Http\Utilities\AuthResponse;

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
        $validationFields = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts'
        ];

        $validationFields = Hook::get('apiPostCategoriesStoreValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);

        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess();
            if ($access !== true) return $access;

            $category = PostCategory::create($request->all());
            return response()->json(["status" => "201", "message" => "Successfully created new category.", "data" => $category], 201);
        }
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

        if ($category) {
            return new CategoryResource($category);
        } else {
            return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        }
    }


    public function update($id, Request $request) {
        $category = PostCategory::find($id);
        if (!$category) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        $validationFields = [
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:posts',
            'description' => 'string|max:255',
        ];
        $validationFields = Hook::get('apiPostCategoriesUpdateValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if($validator->fails()) return ["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()];
        
        $category->update($request->all());

        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $category], 200);
    }

    public function destroy($id) {
        $access = AuthResponse::hasAccess('CATEGORY_DELETE');
        if (!$access === true) return $access;

        $category = PostCategory::find($id);
        if ($category) {
            $category->delete();
            Post::where(['category_id' => $id])->update(['category_id' => 0]);

            return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $category], 200);
        } else {
            return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        }
    }
}
