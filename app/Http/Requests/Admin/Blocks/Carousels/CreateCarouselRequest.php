<?php

namespace App\Http\Requests\Admin\Blocks\Carousels;

use App\Http\Requests\BaseFormRequest;

class CreateCarouselRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'description' => 'string'
        ];
    }
}
