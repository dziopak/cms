<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\UsersEditRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Entities\Layout;
use App\Http\Utilities\Api\Files\FileHandling;
use Auth;

class UsersController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = config('global.general.theme');
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
    }

    public function edit()
    {
        if (!Auth::check()) return redirect('/');

        $user = Auth::user();
        $form = getData('Front/Modules/Users/user_update_form');
        $blocks = getLayout(Layout::findOrFail(1));

        return view('Theme::modules.users.edit', compact('user', 'blocks', 'form'));
    }

    public function update(UsersEditRequest $request)
    {
        if (!Auth::check()) return redirect('/login');


        $user = Auth::user();
        $data = $request->except(['password', 'repeat_password']);


        if (!empty($request->file('file'))) {
            $user->fire_events = false;
            $data['avatar'] = FileHandling::upload($request, true);
        }

        if (!empty($request->get('password'))) {
            $data['password'] = Hash::make($request->get('password'));
        }

        $user->update($data);

        return redirect()->back();
    }
}
