<?php

namespace App\Http\Requests\Api\Modules\Users;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UsersEditRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields =  [
            'email' => 'email|required|unique:users,email,' . $this->request->get('user_id'),
            'role_id' => 'required|numeric',
        ];
        return Hook::filter('user.request.api.update', $fields);
    }
}
