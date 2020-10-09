<?php

namespace App\Composers\Admin;

class UsersComposer
{

    private function index($request, $view)
    {
        $view->users = \App\User::with('role', 'photo')->filter($request)->paginate(15);


        $roles = \App\Role::all('id', 'name')->pluck('name', 'id');

        return [
            'roles' => $roles,
            'table' => getData('Admin/Modules/users/users_index_table')
        ];
    }

    private function create($request, $view)
    {
        $roles = \App\Role::get_all_roles();
        return [
            'form' => getData('Admin/Modules/users/users_create_form', ['roles' => $roles, 'thumbnail' => getThumbnail(null, 1)])
        ];
    }

    private function edit($request, $view)
    {
        $roles = (new \App\Role)->get_all_roles();

        return [
            'user' => \App\User::with('photo')->findOrFail($view->user_id),
            'logs' => $view->user->logs()->take(5)->orderBy('created_at', 'desc')->get(),
            'form' => getData('Admin/Modules/users/users_update_form', ['roles' => $roles, 'thumbnail' => getThumbnail($view->user->photo, 1), 'thumb_endpoint' => route('admin.users.update', $view->user_id)])
        ];
    }

    private function disable($request, $view)
    {
        return [
            'user' => \App\User::findOrFail($view->user_id),
            'logs' => $view->user->account_logs()->take(5)->orderBy('created_at', 'desc')->get()
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

            case 'disable':
                $data = $this->disable($request, $view);
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
