<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class UsersComposers extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        view()->composer('admin.users.index', function ($view) use ($request) {
            $view->users = \App\User::with('role', 'photo')->filter($request)->paginate(15);

            // TO DO //
            $user_roles = \App\Role::all('id', 'name');
            $roles = [];
            foreach ($user_roles as $role) {
                $roles[$role->id] = $role->name;
            }
            // with Ajax //

            $view->roles = $roles;
            $view->table = getData('Admin/users/users_index_table');
        });


        view()->composer('admin.users.create', function ($view) {
            $role = new \App\Role;
            $roles = $role->get_all_roles();
            $view->form = getData('Admin/users/users_create_form', ['roles' => $roles, 'thumbnail' => getThumbnail(null, 1)]);
        });


        view()->composer('admin.users.edit', function ($view) {
            $view->user = \App\User::with('photo')->findOrFail($view->user_id);
            $view->logs = $view->user->logs()->take(5)->orderBy('created_at', 'desc')->get();

            $roles = (new \App\Role)->get_all_roles();
            $view->form = getData('Admin/users/users_update_form', ['roles' => $roles, 'thumbnail' => getThumbnail($view->user->photo, 1)]);
        });


        view()->composer(['admin.users.disable', 'admin.users.delete'], function ($view) {
            $view->user = \App\User::findOrFail($view->user_id);
            $view->logs = $view->user->account_logs()->take(5)->orderBy('created_at', 'desc')->get();
        });
    }
}
