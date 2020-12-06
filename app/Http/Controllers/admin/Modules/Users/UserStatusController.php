<?php

namespace App\Http\Controllers\Admin\Modules\Users;

use App\Services\Admin\Users\UserService;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function edit($id)
    {
        return $this->service->disable($id);
    }

    public function update($id)
    {
        return $this->service->block($id);
    }
}
