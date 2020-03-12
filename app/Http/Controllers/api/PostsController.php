<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\PostResource;
use App\Http\Utilities\AuthResponse;
use App\Http\Utilities\PostUtilities;

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
        $validation = PostUtilities::storeValidation($request);
        if ($validation !== true) return $validation;

        $access = AuthResponse::hasAccess('POST_CREATE');
        if ($access !== true) return $access;

        $user = User::jwtUser();
        $user = User::find($user->id);

        $data = $request->all();
        $data['user_id'] = $user->id;

        $post = Post::create($data);

        return response()->json(["status" => "201", "message" => "Successfully created new post.", "data" => compact('post')], 201);
        
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
            return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validation = PostUtilities::updateValidation($request);
        $access = AuthResponse::hasAccess('POST_UPDATE');
        
        if ($access !== true) return $access;
        if ($validation !== true) return $validation;
        
        $post = Post::find($id);
        if (!$post) return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);    

        $post->update($request->all());
        return response()->json(["status" => "201", "message" => "Successfully updated post.", "data" => compact('post')], 201);
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
