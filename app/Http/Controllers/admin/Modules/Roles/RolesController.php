<?php

namespace App\Http\Controllers\Admin\Modules\Roles;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Roles\CreateRoleRequest;
use App\Http\Requests\Admin\Modules\Roles\UpdateRoleRequest;
use App\Services\Admin\Roles\RoleService;

class RolesController extends BaseAdminController
{
    public $requests = [
        'store' => CreateRoleRequest::class,
        'update' => UpdateRoleRequest::class
    ];

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }
}
