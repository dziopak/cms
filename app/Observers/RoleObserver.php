<?php

namespace App\Observers;

use App\Events\Roles\RoleCreateEvent;
use App\Events\Roles\RoleUpdateEvent;
use App\Events\Roles\RoleDestroyEvent;

use Illuminate\Support\Facades\Session;
use App\Entities\Role;

class RoleObserver
{

    public function created(Role $role)
    {
        if ($role->fire_events) {
            event(new RoleCreateEvent($role));
            Session::flash('crud', __('admin/messages.role.create.success'));
        }
    }


    public function updated(Role $role)
    {
        if ($role->fire_events) {
            event(new RoleUpdateEvent($role));
            Session::flash('crud', __('admin/messages.role.update.success'));
        }
    }


    public function deleted(Role $role)
    {
        $role->users()->update(['role_id' => '1']);

        if ($role->fire_events) {
            event(new RoleDestroyEvent($role));
        }
    }
}
