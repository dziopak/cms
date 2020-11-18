<?php

namespace App\Http\Utilities\Admin\Modules\Roles;

use App\Http\Utilities\RoleAccess;
use App\Entities\Role;
use App\Interfaces\WebEntity;
use Auth;

class RoleEntity implements WebEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.roles.index');
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');

        $data = $request->all();
        if (!empty($data['access'])) $data['access'] = RoleAccess::serializeAccess($data['access']);

        Role::create($data);
        return redirect(route('admin.users.roles.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');
        return view('admin.roles.edit', [
            'role' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('ROLE_EDIT');

        $data = $request->all();
        $data['access'] = RoleAccess::serializeAccess($data['access']);

        $this->item->update($data);
        return redirect(route('admin.users.roles.index'));
    }


    public function duplicate()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_CREATE');
        return view('admin.roles.create', [
            'role' => $this->role
        ]);
    }


    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('ROLE_DELETE');
        $this->item->delete();

        return response()->json(
            [
                'message' => __('admin/messages.roles.delete.success'),
                'id' => $this->item->id
            ],
            200
        );
    }
}
