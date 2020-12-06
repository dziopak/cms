<?php

namespace App\Http\Requests\Admin\Modules\Layouts;

use App\Http\Requests\BaseFormRequest;

class UpdateLayoutRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required'
        ];
    }
}
