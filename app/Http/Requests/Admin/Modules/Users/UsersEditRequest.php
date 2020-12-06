<?php

namespace App\Http\Requests\Admin\Modules\Users;

use App\Http\Requests\BaseFormRequest;

class UsersEditRequest extends BaseFormRequest
{
    public function rules()
    {
        if ($this->request->get('request') == 'photo') return ['file' => 'required|numeric'];

        $validationFields =  [
            'email' => 'email|required|unique:users,email,' . $this->request->get('user_id'),
            'role_id' => 'required|numeric',
        ];

        return $validationFields;
    }
}
