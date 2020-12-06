<?php

namespace App\Http\Requests\Admin\Modules\Users;

use App\Http\Requests\BaseFormRequest;

class NewPasswordRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'password' => 'string|required|min:8',
            'repeat_password' => 'string|required'
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
