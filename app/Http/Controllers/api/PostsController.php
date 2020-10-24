<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Utilities\Api\AuthResponse;
use App\Http\Utilities\PostUtilities;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Utilities\ModelUtilities;
use App\Post;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $posts = QueryBuilder::for(Post::with('author', 'thumbnail', 'category'))
            ->allowedFilters(['created_at', 'updated_at', 'name', 'slug', AllowedFilter::exact('id')])
            ->allowedSorts(['id', 'created_at', 'updated_at'])
            ->defaultSort('-created_at');

        return PostResource::collection(ModelUtilities::scope($posts, $request));
    }


    public function store(Request $request)
    {
        $validation = PostUtilities::storeValidation($request);
        if ($validation !== true) return $validation;

        $post = PostUtilities::create($request);
        return response()->json(["status" => "201", "message" => "Successfully created new post.", "data" => compact('post')], 201);
    }


    public function show($id)
    {
        $post = PostUtilities::prepareAndFind($id);
        if (!$post) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        return new PostResource($post);
    }


    public function update(Request $request, $id)
    {
        $validation = PostUtilities::updateValidation($request);
        if ($validation !== true) return $validation;

        $post = PostUtilities::find($id);
        if (!$post) return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $post->update($request->all());
        return response()->json(["status" => "201", "message" => "Successfully updated post.", "data" => compact('post')], 201);
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('POST_EDIT');
        if (!$access === true) return $access;

        $post = PostUtilities::find($id);
        if (!$post) response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $post->delete();
        return response()->json(["status" => "200", "message" => "Post has been successfully deleted.", "data" => compact('post')], 200);
    }
}
