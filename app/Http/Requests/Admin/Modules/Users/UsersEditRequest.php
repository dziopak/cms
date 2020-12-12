<?php

namespace App\Http\Requests\Admin\Modules\Users;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UsersEditRequest extends BaseFormRequest
{
    public function rules()
    {
        if ($this->request->get('request') == 'photo') return ['file' => 'required|numeric'];

        $fields =  [
            'email' => 'email|required|unique:users,email,' . $this->request->get('user_id'),
            'role_id' => 'required|numeric',
        ];

        return Hook::filter('user.request.admin.update', $fields);
    }
}
