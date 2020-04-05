<?php

    namespace App\Http\Utilities\Admin;

    use App\Role;
    use Auth;

    class RoleUtilities extends \App\Http\Utilities\RoleUtilities {
        public static function store($request) {
            $data = $request->all();
            if (!empty($data['access'])) $data['access'] = RoleUtilities::serializeAccess($data['access']);

            Role::create($data);
            return redirect(route('admin.users.roles.index'));
        }


        public static function update($id, $request) {
            $data = $request->all();
            $data['access'] = RoleUtilities::serializeAccess($data['access']);

            $role = Role::findOrFail($id)->update($data);
            return redirect(route('admin.users.roles.index'));
        }


        public static function destroy($id) {
            $role = Role::findOrFail($id)->delete();
            return redirect(route('admin.users.roles.index'));
        }
    }
