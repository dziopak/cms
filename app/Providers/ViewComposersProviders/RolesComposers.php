<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Utilities\Admin\RoleUtilities;
use App\Role;

class RolesComposers extends ServiceProvider
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
        view()->composer('admin.roles.index', function ($view) use ($request) {
            $view->roles = \App\Role::orderBy('id')->filter($request)->paginate(15);
            $view->table = getData('Admin/roles/roles_index_table');
        });


        view()->composer('admin.roles.create', function ($view) {
            if (!empty($view->role_id)) {
                $role = Role::findOrFail($view->role_id);
                $role->access = RoleUtilities::unserializeAccess($role->access);

                $view->role = $role;
            }
            $view->form = getData('Admin/roles/roles_form');
        });


        view()->composer('admin.roles.edit', function ($view) {
            $role = \App\Role::findOrFail($view->role_id);
            $role->access = \App\Http\Utilities\RoleUtilities::unserializeAccess($role->access);

            $view->role = $role;
            $view->form = getData('Admin/roles/roles_form');
        });
    }
}
