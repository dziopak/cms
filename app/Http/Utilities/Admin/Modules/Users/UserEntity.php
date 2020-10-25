<?php

namespace App\Http\Utilities\Admin\Modules\Users;


use App\Http\Utilities\Admin\Users\UserActions;
use App\Http\Utilities\Admin\Users\UserFiles;
use App\Events\Users\UserNewPasswordEvent;
use Illuminate\Support\Facades\Hash;
use App\Events\Users\UserBlockEvent;
use App\Models\User;

class UserEntity
{


    public static function store($data)
    {
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect(route('admin.users.index'));
    }

    public static function update($id, $request)
    {
        if ($request->get('request') === 'photo') {
            return (new UserFiles($id))->updateThumbnail($request->get('file'));
        }

        User::findOrFail($id)->update($request->except('avatar'));
        return redirect(route('admin.users.index'));
    }


    public static function setUserPassword($id, $request)
    {
        $user = User::findOrFail($id);

        $user->fire_events = false;
        $user->update(['password' => Hash::make($request->password)]);
        event(new UserNewPasswordEvent($user));

        return redirect(route('admin.users.index'));
    }


    public static function blockUser($id, $request)
    {
        (new UserActions($id))->setStatus($request->get('is_active'));
        event(new UserBlockEvent(User::findOrFail($id)));

        return redirect(route('admin.users.index'));
    }


    public static function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.users.delete.success'), 'id' => $id], 200);
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
