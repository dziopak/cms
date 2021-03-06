<?php

namespace App\Http\Requests\Admin\Blocks\Menus;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdateMenuRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required'
        ];
        return Hook::filter('menu.request.admin.update', $fields);
    }
}
