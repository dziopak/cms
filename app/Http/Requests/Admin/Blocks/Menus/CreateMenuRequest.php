<?php

namespace App\Http\Requests\Admin\Blocks\Menus;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreateMenuRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required',
        ];
        return Hook::filter('menu.request.admin.create', $fields);
    }
}
