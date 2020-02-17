<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class CategoriesRequest extends FormRequest
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
        $rules = [
            'name' => 'string|required',
            'category_id' => 'numeric',
            'description' => 'string'
        ];

        switch($this->request->get('category_type')) {
            case 'post':
                $rules['slug'] = 'string|required|unique:post_categories,slug,'.$this->request->get('category_id');
            break;

            case 'page':
                $rules['slug'] = 'string|required|unique:page_categories,slug,'.$this->request->get('category_id');
            break;
        }
        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->request->get('type')) {
                $validator->errors()->add('type', 'Ooops, there was an error. This form is incomplete.');
            }
        });
    }
}
