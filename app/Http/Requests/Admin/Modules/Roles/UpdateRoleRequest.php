<?php

namespace App\Http\Requests\Admin\Modules\Roles;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdateRoleRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'required|string|unique:roles,name,' . $this->request->get('role_id'),
            'description' => 'string|required',
            'access' => 'array',
        ];

        return Hook::filter('role.request.admin.update', $fields);
    }
}
