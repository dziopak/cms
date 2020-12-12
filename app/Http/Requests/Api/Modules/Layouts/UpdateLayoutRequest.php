<?php

namespace App\Http\Requests\Api\Modules\Layouts;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdateLayoutRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required'
        ];
        return Hook::filter('layout.request.api.update', $fields);
    }
}
