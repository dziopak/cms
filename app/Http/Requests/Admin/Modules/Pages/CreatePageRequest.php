<?php

namespace App\Http\Requests\Admin\Modules\Pages;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreatePageRequest extends BaseFormRequest
{
    public function rules()
    {

        $fields = [
            'name' => 'required|string|unique:pages,name,' . $this->request->get('page_id'),
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'content' => 'string|required',
            'category' => 'array',
            'file_id' => 'numeric'
        ];
        return Hook::filter('page.request.admin.create', $fields);
    }
}
