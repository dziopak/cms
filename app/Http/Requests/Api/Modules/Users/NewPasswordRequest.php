<?php

namespace App\Http\Requests\Api\Modules\Users;

use App\Http\Requests\BaseFormRequest;
use Hook;

class NewPasswordRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'password' => 'string|required|min:8',
            'repeat_password' => 'string|required'
        ];
        return Hook::filter('user.request.api.password', $fields);
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
