<?php

namespace App\Http\Requests\Admin\Modules\Categories;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required|unique:categories',
            'category_id' => 'numeric',
            'description' => 'string'
        ];
        return Hook::filter('category.request.admin.create', $fields);
    }
}
