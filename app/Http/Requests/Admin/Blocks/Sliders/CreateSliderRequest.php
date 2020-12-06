<?php

namespace App\Http\Requests\Admin\Blocks\Sliders;

use App\Http\Requests\BaseFormRequest;

class CreateSliderRequest extends BaseFormRequest
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
