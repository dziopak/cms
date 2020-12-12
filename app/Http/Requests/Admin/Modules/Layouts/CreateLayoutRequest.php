<?php

namespace App\Http\Requests\Admin\Modules\Layouts;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreateLayoutRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required'
        ];
        return Hook::filter('layout.request.admin.create', $fields);
    }
}
