<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\Role;
use App\Entities\User;

class UsersComposer
{

    private function index($request, $view)
    {
        return [
            'users' => User::with('role', 'photo')->filter($request)->paginate(15),
            'table' => getData('Admin/Modules/Users/users_index_table')
        ];
    }

    private function create($request, $view)
    {
        return [
            'form' => getData('Admin/Modules/Users/users_create_form', [
                'roles' => Role::get_all_roles(),
                'thumbnail' => getThumbnail(null, 1)
            ])
        ];
    }

    private function edit($request, $view)
    {
        return [
            'logs' => $view->user->logs()->take(5)->orderBy('created_at', 'desc')->get(),
            'form' => getData('Admin/Modules/Users/users_update_form', [
                'roles' => Role::get_all_roles(),
                'thumbnail' => getThumbnail($view->user->photo, 1),
                'thumb_endpoint' => route('admin.users.update', $view->user->id)
            ])
        ];
    }

    private function disable($request, $view)
    {
        return [
            'logs' => $view->user->account_logs()->take(5)->orderBy('created_at', 'desc')->get()
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
