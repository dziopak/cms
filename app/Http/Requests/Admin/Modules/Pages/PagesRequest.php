<?php

namespace App\Http\Requests\Admin\Modules\Pages;

use App\Http\Requests\BaseFormRequest;

class PagesRequest extends BaseFormRequest
{
    public function rules()
    {
        switch ($this->request->get('request')) {

            case 'photo':
                $validation_fields = [
                    'file' => 'required|numeric'
                ];
                break;

            default:
                $validation_fields = [
                    'name' => 'required|string|unique:pages,name,' . $this->request->get('page_id'),
                    'content' => 'string|required',
                    'excerpt' => 'string|required',
                    'content' => 'string|required',
                ];
                break;
        }

        return $validation_fields;
    }
}
