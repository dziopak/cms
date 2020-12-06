<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\BaseFormRequest;

class UsersEditRequest extends BaseFormRequest
{
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
