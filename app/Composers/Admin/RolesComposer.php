<?php

namespace App\Composers\Admin;

use App\Models\Role;
use App\Http\Utilities\RoleAccess;

class RolesComposer
{

    private function index($request, $view)
    {
        return [
            'roles' => Role::orderBy('id')->filter($request)->paginate(15),
            'table' => getData('Admin/Modules/roles/roles_index_table'),
        ];
    }

    private function create($request, $view)
    {
        if (!empty($view->role_id)) {
            $role = Role::findOrFail($view->role_id);
            $role->access = RoleAccess::unserializeAccess($role->access);
            $data['role'] = $role;
        }

        $data['form'] = getData('Admin/Modules/roles/roles_form');
        return $data;
    }

    private function edit($request, $view)
    {
        $role = Role::findOrFail($view->role_id);
        $role->access = RoleAccess::unserializeAccess($role->access);

        return [
            'role' => $role,
            'form' => getData('Admin/Modules/roles/roles_form')
        ];
    }


    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        switch ($vw) {
            case 'index':
                $data = $this->index($request, $view);
                break;

            case 'edit':
                $data = $this->edit($request, $view);
                break;

            case 'create':
                $data = $this->create($request, $view);
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
