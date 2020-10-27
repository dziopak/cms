<?php

namespace App\Http\Utilities\Admin\Modules\Users;

use App\Entities\User;
use Auth;

class UserActions
{
    protected $users;

    public function __construct($users)
    {
        is_array($users) ? $this->users = $users : $this->users = [$users];
    }

    private function delete()
    {
        Auth::user()->hasAccessOrRedirect('USER_DELETE');
        User::whereIn('id', $this->users)->delete();

        return __('admin/messages.users.mass.universal');
    }

    public function setStatus($status)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        User::whereIn('id', $this->users)->update(['is_active' => $status]);

        return __('admin/messages.users.mass.universal');
    }

    private function setRole($role_id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        User::whereIn('id', $this->users)->update(['role_id' => $role_id]);

        return __('admin/messages.users.mass.universal');
    }

    public function mass($data)
    {
        switch ($data['mass_action']) {
            case 'delete':
                return $this->delete();
                break;

            case 'hide':
                return $this->setStatus(false);
                break;

            case 'show':
                return $this->setStatus(true);
                break;

            case 'user_role':
                return $this->setRole($data['role_id']);
                break;
        }
    }
}
