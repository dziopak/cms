<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
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

        $validationFields =  [
            'email' => 'email|required|unique:users,email,' . $this->request->get('user_id'),
        ];

        if (!empty($password)) {
            $validationFields['password'] = 'min:8|required_with:repeat_password|same:repeat_password';
            $validationFields['repeat_password'] = 'min:8';
        }

        return $validationFields;
    }
}
