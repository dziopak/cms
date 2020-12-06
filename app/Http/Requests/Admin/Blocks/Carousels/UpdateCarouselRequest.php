<?php

namespace App\Http\Requests\Admin\Blocks\Carousels;

use App\Http\Requests\BaseFormRequest;

class UpdateCarouselRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'description' => 'string'
        ];
    }
}
