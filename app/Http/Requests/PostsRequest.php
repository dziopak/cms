<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hook;

class PostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation_fields = [
            'name' => 'string|required',
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'slug' => 'string|required|unique:posts,slug,'.$this->request->get('post_id'),
            'content' => 'string|required',
            'category_id' => 'numeric|required',
        ];

        $validation_fields = Hook::get('adminPagesValidation',[$validation_fields],function($validation_fields){
            return $validation_fields;
        });

        return $validation_fields;
    }
}
