<?php

namespace App\Http\Requests\Admin\Blocks\Carousels;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreateCarouselRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'string|required',
            'description' => 'string'
        ];
        return Hook::filter('carousel.request.admin.create', $fields);
    }
}
