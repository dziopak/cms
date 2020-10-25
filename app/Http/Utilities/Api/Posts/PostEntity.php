<?php

namespace App\Http\Utilities\Api\Posts;

use App\Http\Utilities\Api\AuthResponse;
use App\Http\Resources\PostResource;
use App\Http\Utilities\ModelUtilities;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\User;
use App\Models\Post;
use Hook;

class PostEntity
{
    static function index($request)
    {
        $filters = ['created_at', 'updated_at', 'name', 'slug', AllowedFilter::exact('id')];
        $sorting = ['id', 'created_at', 'updated_at'];

        $posts = QueryBuilder::for(Post::with('author', 'thumbnail', 'category'))
            ->allowedFilters($filters)
            ->allowedSorts($sorting)
            ->defaultSort('-created_at');

        return PostResource::collection(ModelUtilities::scope($posts, $request));
    }


    static function store($request)
    {
        $validation = PostValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        $post = PostEntity::create($request);
        return response()->json(["status" => "201", "message" => "Successfully created new post.", "data" => compact('post')], 201);
    }


    static function show($id)
    {
        $post = PostEntity::prepareAndFind($id);
        if (!$post) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        return new PostResource($post);
    }


    static function update($request, $id)
    {
        $validation = PostValidation::updateValidation($request);
        if ($validation !== true) return $validation;

        $post = PostEntity::find($id);
        if (!$post) return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $post->update($request->all());
        return response()->json(["status" => "201", "message" => "Successfully updated post.", "data" => compact('post')], 201);
    }


    static function destroy($id)
    {
        $access = AuthResponse::hasAccess('POST_EDIT');
        if (!$access === true) return $access;

        $post = PostEntity::find($id);
        if (!$post) response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $post->delete();
        return response()->json(["status" => "200", "message" => "Post has been successfully deleted.", "data" => compact('post')], 200);
    }


    static function create($request)
    {
        $user = User::find(User::jwtUser()->id);

        $data = $request->all();
        $data['user_id'] = $user->id;

        return Post::create($data);
    }


    static function find($id)
    {
        if (is_numeric($id)) {
            $post = Post::find($id);
        } else {
            $post = Post::where(['slug' => $id]);
            $post = Hook::get('apiPostFindSelector', [$post, $id], function ($category, $id) {
                return $post;
            });
            $post = $post->first();
        }

        return $post;
    }


    static function prepareAndFind($id)
    {
        if (is_numeric($id)) {
            $post = Post::with('author', 'category', 'thumbnail')->find($id);
        } else {
            $post = Post::with('author', 'category', 'thumbnail')->where(['slug' => $id]);
            $post = Hook::get('apiPostFindSelector', [$post, $id], function ($category, $id) {
                return $post;
            });
            $post = $post->first();
        }

        return $post;
    }
}
