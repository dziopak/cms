<?php

namespace App\Http\Requests\Admin\Modules\Posts;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdatePostRequest extends BaseFormRequest
{
    public function rules()
    {
        if ($this->request->get('request') === 'photo') return ['file' => 'required|numeric'];

        $fields = [
            'name' => 'required|string|unique:posts,name,' . $this->request->get('post_id'),
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'content' => 'string|required',
            'category' => 'array',
        ];
        return Hook::filter('post.request.admin.update', $fields);
    }
}
