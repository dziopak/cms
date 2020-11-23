<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\Role;
use App\Http\Utilities\RoleAccess;

class RolesComposer
{

    private function index($request, $view)
    {
        return [
            'table' => getData('Admin/Modules/Roles/roles_index_table'),
        ];
    }

    private function create($request, $view)
    {
        if (!empty($view->role)) {
            $view->role->access = RoleAccess::unserializeAccess($view->role->access);
            $data['role'] = $view->role;
        }

        $data['form'] = getData('Admin/Modules/Roles/roles_form');
        return $data;
    }

    private function edit($request, $view)
    {
        $view->role->access = RoleAccess::unserializeAccess($view->role->access);

        return [
            'form' => getData('Admin/Modules/Roles/roles_form')
        ];
    }


    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        // Boot proper method
        if (method_exists($this, $vw)) {
            $data = $this->$vw($request, $view);
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
