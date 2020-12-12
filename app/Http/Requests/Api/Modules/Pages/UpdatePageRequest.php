<?php

namespace App\Http\Requests\Api\Modules\Pages;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdatePageRequest extends BaseFormRequest
{
    public function rules()
    {
        if ($this->request->get('request') === 'photo') return ['file' => 'required|numeric'];

        $fields = [
            'name' => 'required|string|unique:pages,name,' . $this->request->get('page_id'),
            'content' => 'string|required',
            'excerpt' => 'string|required',
            'content' => 'string|required',
            'category' => 'array',
            'file_id' => 'numeric'
        ];
        return Hook::filter('page.request.api.update', $fields);
    }
}
