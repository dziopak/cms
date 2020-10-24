<?php

namespace App\Http\Utilities\Admin\Modules\Users;

use App\User;
use Auth;

class UserFiles
{
    protected $users;

    public function __construct($users)
    {
        is_array($users) ? $this->users = $users : $this->users = [$users];
    }

    public function updateThumbnail($file_id)
    {
        Auth::user()->hasAccessOrRedirect('USER_EDIT');
        $users = User::findOrFail([$this->users]);

        foreach ($users as $user) {
            $user->fire_events = false;
            $user->update(['avatar' => $file_id]);
            if ($file_id === 0) {
                $path = 'assets/no-thumbnail.png';
            } else {
                $path = \App\File::select('path')->findOrFail($file_id)->path;
            }
        }

        return response()->json([
            'message' => __('admin/messages.users.update.thumbnail.success'),
            'file' => $file_id,
            'path' => $path
        ]);
    }
}
