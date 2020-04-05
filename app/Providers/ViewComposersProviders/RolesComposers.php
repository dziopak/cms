<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

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
            $view->table = getData('admin/roles/roles_index_table');
        });


        view()->composer('admin.roles.create', function ($view) {    
            $view->form = getData('admin/roles/roles_form');
        });


        view()->composer('admin.roles.edit', function ($view) {    
            $role = \App\Role::findOrFail($view->role_id);
            $role->access = \App\Http\Utilities\RoleUtilities::unserializeAccess($role->access);

            $view->role = $role;
            $view->form = getData('admin/roles/roles_form');
        });
    }
}
