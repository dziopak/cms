<?php

namespace App\Http\Requests\Admin\Modules\Categories;

use App\Http\Requests\BaseFormRequest;

class CategoriesRequest extends BaseFormRequest
{
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
