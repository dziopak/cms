<?php

namespace App\Http\Requests\Admin\Modules\Categories;

use Illuminate\Foundation\Http\FormRequest;

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
        $validation_fields = [
            'name' => 'string|required|unique:' . 'categories,name,' . $this->request->get('category_id'),
            'category_id' => 'numeric',
            'description' => 'string'
        ];

        return $validation_fields;
    }
}
