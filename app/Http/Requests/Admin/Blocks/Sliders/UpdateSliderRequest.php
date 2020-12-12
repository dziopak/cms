<?php

namespace App\Http\Requests\Admin\Blocks\Sliders;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdateSliderRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required'
        ];
        return Hook::filter('slider.request.admin.update', $fields);
    }
}
