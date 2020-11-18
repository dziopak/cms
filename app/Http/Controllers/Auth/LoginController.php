<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Layout;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';
    private $layout;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->layout = getConfig('general', 'layout');
    }


    protected function authenticated(Request $request, $user)
    {
        $user->fire_events = false;
        $user->update([
            'last_login' => Carbon::now()->toDateTimeString()
        ]);
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }


    public function showLoginForm(Request $request)
    {
        $blocks = Layout::findOrFail($this->layout)->getLayout();
        return view('Theme::modules.users.login', compact('blocks'));
    }
}
