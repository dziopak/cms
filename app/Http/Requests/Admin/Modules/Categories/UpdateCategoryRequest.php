<?php

namespace App\Http\Requests\Admin\Modules\Categories;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required|unique:' . 'categories,name,' . $this->request->get('id'),
            'category_id' => 'numeric',
            'description' => 'string'
        ];

        return Hook::filter('category.request.admin.update', $fields);
    }
}
