<?php

namespace App\Http\Requests;

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
            'category_id' => 'numeric|required',
        ];


        return $validation_fields = Hook::get('adminPagesValidation', [$validation_fields], function ($validation_fields) {
            return $validation_fields;
        });
    }
}
