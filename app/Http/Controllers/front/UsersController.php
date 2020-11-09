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

    private $layout;


    public function __construct()
    {
        $this->layout = getConfig('general', 'layout');
    }


    public function edit()
    {
        if (!Auth::check()) return redirect('/login');

        return view('Theme::modules.users.edit', [
            'user' => Auth::user(),
            'form' => getData('Front/Modules/Users/user_update_form'),
            'blocks' => Layout::findOrFail($this->layout)->getLayout()
        ]);
    }

    public function update(UsersEditRequest $request)
    {
        if (!$user = Auth::user()) return redirect('/login');

        $data = $request->except(['password', 'repeat_password']);
        // Picture upload
        if (!empty($request->file('file'))) $data['avatar'] = FileHandling::upload($request, true);
        // Password change
        if (!empty($request->get('password'))) $data['password'] = Hash::make($request->get('password'));

        $user->update($data);
        return redirect()->back();
    }
}
