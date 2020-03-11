<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\PostResource;
use App\Http\Utilities\AuthResponse;

use App\Post;
use App\User;
use JWTAuth;
use Hook;

class PostsController extends Controller
{
    
    public function index(Request $request)
    {
        return PostResource::collection(Post::with('author', 'thumbnail', 'category')->orderBy('id')->paginate(15));
    }


    public function store(Request $request)
    {
        $validationFields = [
            'name' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'content' => 'required|string'
        ];
        $validationFields = Hook::get('apiPostsStoreValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess('POST_CREATE');
            if ($access !== true) return $access;

            $user = User::jwtUser();
            $user = User::find($user->id);

            $data = $request->all();
            $data['user_id'] = $user->id;

            $post = Post::create($data);

            return response()->json(["status" => "201", "message" => "Successfully created new post.", "data" => compact('post')], 201);
        }
    }


    public function show($id)
    {
        if (is_numeric($id)) {
            $post = Post::with('author', 'category', 'thumbnail')->find($id);
        } else {
            $post = Post::with('author', 'category', 'thumbnail')->where(['slug' => $id])->orWhere(['slug_pl' => $id])->first();
        }

        if ($post) {
            return new PostResource($post);
        } else {
            return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validationFields = [
            'name' => 'string|max:255',
            'excerpt' => 'string|max:255',
            'slug' => 'string|max:255|unique:posts',
            'content' => 'string'
        ];
        $validationFields = Hook::get('apiPostsUpdateValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess('POST_UPDATE');
            if (!$access === true) return $access;
            
            $post = Post::find($id);
            if ($post) {
                $data = $request->all();
                $post->update($data);
    
                return response()->json(["status" => "201", "message" => "Successfully updated new post.", "data" => compact('post')], 201);
            } else {
                return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);    
            }
        }
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('POST_UPDATE');
        if (!$access === true) return $access;

        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(["status" => "200", "message" => "Post has been successfully deleted.", "data" => compact('post')], 200);
        } else {
            return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);
        }
    }
}
