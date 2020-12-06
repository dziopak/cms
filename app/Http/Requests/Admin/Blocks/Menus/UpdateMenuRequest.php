<?php

namespace App\Http\Requests\Admin\Blocks\Menus;

use App\Http\Requests\BaseFormRequest;

class UpdateMenuRequest extends BaseFormRequest
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
