<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'string|required',
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'slug' => 'string|required|unique:posts,slug,'.$this->request->get('post_id'),
            'content' => 'string|required',
            'category_id' => 'numeric|required',
        ];
    }
}
