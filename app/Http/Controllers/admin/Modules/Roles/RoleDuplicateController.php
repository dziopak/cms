<?php

namespace App\Http\Controllers\Admin\Modules\Roles;

use App\Entities\Role;
use App\Http\Controllers\Controller;
use Auth;

class RoleDuplicateController extends Controller
{

    public function __invoke($role)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create', [
            'role' => Role::findOrFail($role)
        ]);
    }
}
