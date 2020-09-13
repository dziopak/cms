<?php

namespace App\Http\Utilities\Admin;

use Illuminate\Support\Facades\Hash;

use App\Events\Users\UserNewPasswordEvent;
use App\Events\Users\UserBlockEvent;

use App\Http\Utilities\ModelUtilities;
use App\User;
use Auth;

class UserUtilities extends \App\Http\Utilities\UserUtilities
{


    public static function store($request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        User::create($data);
        return redirect(route('admin.users.index'));
    }


    public static function update_thumbnail($id, $request)
    {
        $user = \App\User::findOrFail($id);
        $user->fire_events = false;
        $user->update(['avatar' => $request->get('file')]);

        if ($request->get('file') === 0) {
            $path = 'assets/no-avatar.png';
        } else {
            $path = \App\File::select('path')->findOrFail($request->get('file'))->path;
        }

        return $path;
    }


    public static function update($id, $request)
    {

        switch ($request->get('request')) {
            case 'photo':
                $path = UserUtilities::update_thumbnail($id, $request);
                return response()->json(['message' => 'Successfully updated user\'s photo.', 'file' => $request->get('file'), 'path' => $path]);
                break;

            default:
                User::findOrFail($id)->update($request->except('avatar'));
                return redirect(route('admin.users.index'));
                break;
        }
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
        $user = User::findOrFail($id);
        $is_active = $request->get('is_active');

        $user->is_active = $is_active;
        $user->save();

        event(new UserBlockEvent($user));
        return redirect(route('admin.users.index'));
    }


    public static function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'Successfully deleted user.', 'id' => $id], 200);
    }


    public static function massAction($request)
    {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', 'No users were selected.');
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('USER_DELETE');
                    User::whereIn('id', $data['mass_edit'])->delete();
                    break;

                case 'hide':
                    Auth::user()->hasAccessOrRedirect('USER_EDIT');
                    User::whereIn('id', $data['mass_edit'])->update(['is_active' => 0]);
                    break;

                case 'show':
                    Auth::user()->hasAccessOrRedirect('USER_EDIT');
                    User::whereIn('id', $data['mass_edit'])->update(['is_active' => 1]);
                    break;

                case 'user_role':
                    Auth::user()->hasAccessOrRedirect('USER_EDIT');
                    User::whereIn('id', $data['mass_edit'])->update(['role_id' => $data['role']]);
                    break;
            }
        }
        return redirect(route('admin.users.index'));
    }
}
