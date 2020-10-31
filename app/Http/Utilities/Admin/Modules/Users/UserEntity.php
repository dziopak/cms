<?php

namespace App\Http\Utilities\Admin\Modules\Users;


use App\Http\Utilities\Admin\Modules\Users\UserActions;
use App\Http\Utilities\Admin\Modules\Users\UserFiles;
use App\Events\Users\UserNewPasswordEvent;
use Illuminate\Support\Facades\Hash;
use App\Events\Users\UserBlockEvent;
use App\Entities\User;

class UserEntity
{


    public static function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect(route('admin.users.index'));
    }

    public static function update(User $user, $request)
    {
        if ($request->get('request') === 'photo') {
            return (new UserFiles($user->id))->updateThumbnail($request->get('file'));
        }

        $user->update($request->except('avatar'));
        return redirect(route('admin.users.index'));
    }


    public static function setUserPassword(User $user, $request)
    {
        $user->fire_events = false;
        $user->update(['password' => Hash::make($request->password)]);
        event(new UserNewPasswordEvent($user));

        return redirect(route('admin.users.index'));
    }


    public static function block(User $user, $request)
    {
        (new UserActions($user->id))->setStatus($request->get('is_active'));
        event(new UserBlockEvent($user));

        return redirect(route('admin.users.index'));
    }


    public static function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => __('admin/messages.users.delete.success'), 'id' => $user->id], 200);
    }


    public static function massAction($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.users.mass.errors.no_users'));
        }

        $msg = (new UserActions($data['mass_edit']))->mass($data);
        return redirect()->back()->with('crud', $msg);
    }
}
