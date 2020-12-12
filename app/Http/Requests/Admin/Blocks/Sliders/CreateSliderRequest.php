<?php

namespace App\Http\Requests\Admin\Blocks\Sliders;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreateSliderRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required'
        ];
        return Hook::filter('slider.request.admin.create', $fields);
    }
}
