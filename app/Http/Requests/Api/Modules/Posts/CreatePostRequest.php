<?php

namespace App\Http\Requests\Api\Modules\Posts;

use App\Http\Requests\BaseApiRequest;
use Hook;

class CreatePostRequest extends BaseApiRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'required|string|unique:posts',
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'content' => 'string|required',
            'category' => 'array',
            'file_id' => 'numeric'
        ];
        return Hook::filter('post.request.api.create', $fields);
    }
}
