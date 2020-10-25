<?php

namespace App\Http\Utilities\Admin\Modules\Roles;

use App\Http\Utilities\RoleAccess;
use App\Models\Role;

class RoleEntity
{
    public static function store($request)
    {
        $data = $request->all();
        if (!empty($data['access'])) $data['access'] = RoleAccess::serializeAccess($data['access']);

        Role::create($data);
        return redirect(route('admin.users.roles.index'));
    }


    public static function update($id, $request)
    {
        $data = $request->all();
        $data['access'] = RoleAccess::serializeAccess($data['access']);

        Role::findOrFail($id)->update($data);
        return redirect(route('admin.users.roles.index'));
    }


    public static function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect(route('admin.users.roles.index'));
    }
}
