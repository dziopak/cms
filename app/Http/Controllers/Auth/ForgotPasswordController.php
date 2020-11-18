<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Entities\Layout;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    private $layout;


    public function __construct()
    {
        $this->layout = getConfig('general', 'layout') ?: 1;
    }


    public function showLinkRequestForm()
    {
        return view('Theme::modules.users.password_forgot', [
            'blocks' => Layout::findOrFail($this->layout)->getLayout()
        ]);
    }
}
