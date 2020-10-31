<?php

namespace App\Observers;

use App\Entities\User;
use Illuminate\Support\Facades\Session;

use App\Events\Users\UserCreateEvent;
use App\Events\Users\UserUpdateEvent;
use App\Events\Users\UserDestroyEvent;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->fire_events) {
            event(new UserCreateEvent($user, request()->file('avatar')));
            Session::flash('crud', __('admin/messages.users.create.success'));
        }
    }


    public function updated(User $user)
    {
        if ($user->fire_events) {
            event(new UserUpdateEvent($user, request()->file('avatar')));
            Session::flash('crud', __('admin/messages.users.update.success'));
        }
    }


    public function deleted(User $user)
    {
        $user->account_logs()->delete();

        if ($user->avatar != "0") {
            if (!empty($user->avatar->path)) {
                unlink(public_path() . '/images/' . $user->photo->path);
                $user->photo()->delete();
            }
        }

        if ($user->fire_events) {
            event(new UserDestroyEvent($user));
        }
    }
}
