<?php

namespace App\Http\Utilities\Api\v1\Posts;

use App\Http\Utilities\Api\AuthResponse;
use App\Http\Resources\PostResource;
use App\Interfaces\ApiEntity;


class PostEntity implements ApiEntity
{
    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    public function show()
    {
        if (!$this->item) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        return new PostResource($this->item);
    }


    static function store($request)
    {
        $item = $request->all();
        if (!$valid = PostValidation::validate([$item], 'store', 'POST_CREATE')) return $valid;
        $post = PostActions::create(PostActions::prepareToStore($item));

        return response()->json([
            "status" => "201",
            "message" => "Successfully created new post.",
            "data" => compact('post')
        ], 201);
    }


    public function update($request)
    {
        if (!$validation = PostValidation::validate([$request->all()], 'update', 'POST_EDIT')) return response()->json($validation, 501);
        if (empty($this->item)) return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $this->item->update(PostActions::prepareToUpdate($request->all()));
        return response()->json(["status" => "201", "message" => "Successfully updated post.", "data" => ['post' => $this->item->fresh()]], 201);
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccessAndRespond('POST_EDIT');

        if (!$access === true) return $access;
        if (!$this->item) response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);

        $this->item->delete();
        return response()->json(["status" => "200", "message" => "Post has been successfully deleted.", "data" => ['post' => $this->item]], 200);
    }
}
