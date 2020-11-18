<?php

namespace App\Http\Controllers\Front;

use App\Entities\Layout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Front\UsersSocialRequest;
use Hash;
use Auth;

class SocialProfileController extends Controller
{

    private $layout;

    public function __construct()
    {
        $this->layout = getConfig('general', 'layout') ?? 1;
    }


    private function fields()
    {
        $user = Auth::user();

        return [
            'email' => empty($user->email),
            'password' => empty($user->password)
        ];
    }


    private function layout()
    {
        return Layout::findOrFail($this->layout)->getLayout();
    }


    public function update(UsersSocialRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'email' => $request->get('email') ?: Auth::user()->email,
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect(url('/'));
    }


    public function index(Request $request)
    {
        $fields = $this->fields();
        if (!$fields['email'] && !$fields['password']) return redirect(url('/'));

        return view('Theme::modules.users.social', [
            'blocks' => $this->layout(),
            'fields' => $fields
        ]);
    }
}
