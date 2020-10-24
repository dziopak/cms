<?php

namespace App\Http\Utilities;

use Illuminate\Support\Facades\Validator;
use App\Http\Utilities\Api\AuthResponse;

use App\User;
use App\Post;
use Hook;

class PostUtilities
{
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

    static function create($request)
    {
        $user = User::jwtUser();
        $user = User::find($user->id);

        $data = $request->all();
        $data['user_id'] = $user->id;

        return $post = Post::create($data);
    }

    static function storeValidation($request)
    {
        $access = AuthResponse::hasAccess('POST_CREATE');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'content' => 'required|string'
        ];
        $validationFields = Hook::get('apiPostsStoreValidation', [$validationFields], function ($validationFields) {
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) {
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        }

        return true;
    }

    static function updateValidation($request)
    {
        $access = AuthResponse::hasAccess('POST_EDIT');
        if ($access !== true) return $access;

        $validationFields = [
            'name' => 'string|max:255',
            'excerpt' => 'string|max:255',
            'slug' => 'string|max:255|unique:posts',
            'content' => 'string'
        ];
        $validationFields = Hook::get('apiPostsUpdateValidation', [$validationFields], function ($validationFields) {
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);
        if ($validator->fails()) {
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        }

        return true;
    }
}
