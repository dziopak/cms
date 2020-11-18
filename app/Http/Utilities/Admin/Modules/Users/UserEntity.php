<?php

namespace App\Http\Utilities\Admin\Modules\Users;


use App\Http\Utilities\Admin\Modules\Users\UserActions;
use App\Http\Utilities\Admin\Modules\Users\UserFiles;
use App\Events\Users\UserNewPasswordEvent;
use Illuminate\Support\Facades\Hash;
use App\Events\Users\UserBlockEvent;
use App\Entities\User;
use App\Interfaces\WebEntity;
use Auth;

class UserEntity implements WebEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.users.index');
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');
        return view('admin.users.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('USER_CREATE');

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect(route('admin.users.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.edit', [
            'user' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        if ($request->get('request') === 'photo') {
            return (new UserFiles($this->item->id))->updateThumbnail($request->get('file'));
        }

        $this->item->update($request->except('avatar'));
        return redirect(route('admin.users.index'));
    }


    public function setUserPassword($request)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        $this->item->fire_events = false;
        $this->item->update(['password' => Hash::make($request->password)]);
        event(new UserNewPasswordEvent($this->item));

        return redirect(route('admin.users.index'));
    }


    public function disable()
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        return view('admin.users.disable', [
            'user' => $this->item
        ]);
    }


    public function block($request)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');

        (new UserActions($this->item->id))->setStatus($request->get('is_active'));
        event(new UserBlockEvent($this->item));

        return redirect(route('admin.users.index'));
    }


    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        $this->item->delete();

        return response()->json([
            'message' => __('admin/messages.users.delete.success'),
            'id' => $this->item->id
        ], 200);
    }


    public static function mass($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.users.mass.errors.no_users'));
        }

        $msg = (new UserActions($data['mass_edit']))->mass($data);
        return redirect()->back()->with('crud', $msg);
    }
}
