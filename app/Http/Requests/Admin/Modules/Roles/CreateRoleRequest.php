<?php

namespace App\Http\Requests\Admin\Modules\Roles;

use App\Http\Requests\BaseFormRequest;
use Hook;

class CreateRoleRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'required|string|unique:roles',
            'description' => 'string|required',
            'access' => 'array',
        ];
        return Hook::filter('role.request.admin.create', $fields);
    }
}
