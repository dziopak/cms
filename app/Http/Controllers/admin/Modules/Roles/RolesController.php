<?php

namespace App\Http\Controllers\Admin\Modules\Roles;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Services\Admin\Roles\RoleService;
use Auth;

class RolesController extends BaseAdminController
{
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }
}
