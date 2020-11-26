<?php

namespace App\Http\Requests\Admin\Modules\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Hook;

class PostsRequest extends FormRequest
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
