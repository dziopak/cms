<?php

namespace App\Http\Requests\Admin\Modules\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Hook;

class PagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
