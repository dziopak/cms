<?php

namespace App\Http\Controllers\Admin\Modules\Users;

use App\Http\Requests\Admin\Modules\Users\UsersCreateRequest;
use App\Http\Requests\Admin\Modules\Users\UsersEditRequest;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Services\Admin\Users\UserService;

class UsersController extends BaseAdminController
{

    public $requests = [
        'store' => UsersCreateRequest::class,
        'update' => UsersEditRequest::class
    ];

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
