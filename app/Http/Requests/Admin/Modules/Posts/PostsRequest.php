<?php

namespace App\Http\Requests\Admin\Modules\Posts;

use App\Http\Requests\BaseFormRequest;

class PostsRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        if ($this->request->get('request') === 'photo') return ['file' => 'required|numeric'];

        $validation_fields = [
            'name' => 'required|string|unique:posts,name,' . $this->request->get('post_id'),
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'content' => 'string|required',
        ];

        return $validation_fields;
    }
}
