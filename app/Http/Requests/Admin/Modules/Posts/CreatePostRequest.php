<?php

namespace App\Http\Requests\Admin\Modules\Posts;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreatePostRequest extends BaseFormRequest
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
        return Hook::filter('post.request.admin.create', $fields);
    }
}
