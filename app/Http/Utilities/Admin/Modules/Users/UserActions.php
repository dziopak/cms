<?php

namespace App\Http\Utilities\Admin\Modules\Users;

use App\Entities\User;
use App\Events\Users\UserDestroyEvent;
use App\Events\Users\UserUpdateEvent;
use Auth;

class UserActions
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
        Auth::user()->hasAccessOrRedirect('USER_DELETE');

        dispatchEvent(UserDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            User::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.users.mass.universal'));
    }


    public function show()
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        $this->items->update(['is_active' => 1]);
        dispatchEvent(UserUpdateEvent::class, $this->items, function () {
            User::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.users.mass.universal'));
    }


    public function hide()
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        $this->items->update(['is_active' => 0]);
        dispatchEvent(UserUpdateEvent::class, $this->items, function () {
            User::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.users.mass.universal'));
    }


    public function user_role()
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        $this->items->update(['role_id' => $this->request->get('role')]);
        dispatchEvent(UserUpdateEvent::class, $this->items, function () {
            User::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.users.mass.universal'));
    }
}
