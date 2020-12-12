<?php

namespace App\Http\Requests\Api\Modules\Roles;

use App\Http\Requests\BaseFormRequest;
use Hook;

class UpdateRoleRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = [
            'name' => 'required|string|unique:roles',
            'description' => 'string|required',
            'access' => 'array',
        ];

        return Hook::filter('role.request.api.update', $fields);
    }
}
