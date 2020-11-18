<?php

namespace App\Http\Utilities\Api\Posts;

use App\Http\Utilities\Api\AuthResponse;
use App\Http\Resources\PostResource;
use App\Http\Utilities\ModelUtilities;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Entities\User;
use App\Entities\Post;
use App\Interfaces\ApiEntity;
use Hook;

class PostEntity implements ApiEntity
{
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

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


    public function show()
    {
        if (!$this->item) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        return new PostResource($this->item);
    }


    public function update($request)
    {
        $validation = PostValidation::updateValidation($request);

        if ($validation !== true) return $validation;
        if (!$this->item) return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $this->item->update($request->all());
        return response()->json(["status" => "201", "message" => "Successfully updated post.", "data" => compact('post')], 201);
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccess('POST_EDIT');

        if (!$access === true) return $access;
        if (!$this->item) response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $this->item->delete();
        return response()->json(["status" => "200", "message" => "Post has been successfully deleted.", "data" => compact('post')], 200);
    }


    static function create($request)
    {
        $user = User::find(User::jwtUser()->id);

        $data = $request->all();
        $data['user_id'] = $user->id;

        return Post::create($data);
    }


    static function prepareAndFind($id)
    {
        return Post::with('author', 'category', 'thumbnail')->findBySlug($id);
    }
}
