<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Layout;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{

    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;
    private $layout;


    public function __construct()
    {
        $this->middleware('auth');
        $this->layout = getConfig('general', 'layout') ?: 1;
    }


    public function showConfirmForm()
    {
        $blocks = Layout::findOrFail($this->layout)->getLayout();
        return view('Theme::modules.users.password_confirm', compact('blocks'));
    }
}
