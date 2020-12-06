<?php

namespace App\Http\Controllers\Admin\Modules\Users;

use App\Http\Requests\Admin\Modules\Users\NewPasswordRequest;
use App\Services\Admin\Users\UserService;
use App\Http\Controllers\Controller;

class UserPasswordController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(NewPasswordRequest $request, $id)
    {
        return $this->service->setUserPassword($request, $id);
    }
}
