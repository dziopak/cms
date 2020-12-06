<?php

namespace App\Http\Requests\Admin\Blocks\Menus;

use App\Http\Requests\BaseFormRequest;

class CreateMenuRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required'
        ];
    }
}
