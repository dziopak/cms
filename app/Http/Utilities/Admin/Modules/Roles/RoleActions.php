<?php

namespace App\Http\Utilities\Admin\Modules\Roles;

use App\Entities\Role;
use App\Events\Roles\RoleDestroyEvent;
use Auth;

class RoleActions
{

    protected $items;
    private $request;


    public function __construct($items, $request)
    {
        $this->items = $items;
        $this->request = $request;
    }


    public function delete()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');

        dispatchEvent(RoleDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            Role::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.roles.mass.universal'));
    }

    public function name_replace()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');

        $searched = $this->request->get('name_search_string') ?? null;
        $replace = $this->request->get('name_replace_string') ?? null;
        $items = $this->items->get(['id', 'name']);

        if (empty($searched || empty($replace))) return false;

        foreach ($items as $role) {
            if (strpos($role->name, $searched) !== false) {
                $role->name = str_replace($searched, $replace, $role->name);
                $role->save();
            }
        }

        dispatchEvent(RoleUpdateEvent::class, $this->items);

        return redirect()->back()->with('crud', __('admin/messages.roles.mass.title_replace_phrases'));
    }
}
