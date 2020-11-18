<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Entities\Layout;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;
    private $layout;


    public function __construct()
    {
        $this->layout = getConfig('general', 'layout') ?: 1;
    }


    public function showResetForm(Request $request)
    {
        return view('Theme::modules.users.password_reset', [
            'token' => $request->route()->parameter('token'),
            'email' => $request->email,
            'blocks' => Layout::findOrFail($this->layout)->getLayout()
        ]);
    }
}
