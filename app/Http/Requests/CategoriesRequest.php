<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Hook;


class CategoriesRequest extends FormRequest
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
        $validation_fields = [
            'name' => 'string|required|unique:' . $this->request->get('type') . '_categories,name,' . $this->request->get('category_id'),
            'category_id' => 'numeric',
            'description' => 'string'
        ];

        $validation_fields = Hook::get('admin' . ucfirst($this->request->get('type')) . 'CategoriesValidation', [$validation_fields], function ($validation_fields) {
            return $validation_fields;
        });

        return $validation_fields;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->request->get('type')) {
                $validator->errors()->add('type', 'Ooops, there was an error. This form is incomplete.');
            }
        });
    }
}
