<?php

namespace App\Http\Requests\Admin\Modules\Users;

use App\Http\Requests\BaseFormRequest;

class UsersCreateRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'role_id' => 'required|numeric',
            'password' => 'required|min:8',
            'repeat_password' => 'required'
        ];
    }

    public function withValidator($validator)
    {
        parent::withValidator($validator);
        $validator->after(function ($validator) {
            if ($this->password !== $this->repeat_password) {
                $validator->errors()->add('repeat_password', 'Passwords do not match.');
            }
        });
        return;
    }
}
