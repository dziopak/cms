<?php

namespace App\Composers\Admin;

class RolesComposer
{

    private function index($request, $view)
    {
        return [
            'roles' => \App\Role::orderBy('id')->filter($request)->paginate(15),
            'table' => getData('Admin/Modules/roles/roles_index_table'),
        ];
    }

    private function create($request, $view)
    {
        if (!empty($view->role_id)) {
            $role = \App\Role::findOrFail($view->role_id);
            $role->access = \App\Http\Utilities\Admin\RoleUtilities::unserializeAccess($role->access);
            $data['role'] = $role;
        }

        $data['form'] = getData('Admin/Modules/roles/roles_form');
        return $data;
    }

    private function edit($request, $view)
    {
        $role = \App\Role::findOrFail($view->role_id);
        $role->access = \App\Http\Utilities\RoleUtilities::unserializeAccess($role->access);

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
