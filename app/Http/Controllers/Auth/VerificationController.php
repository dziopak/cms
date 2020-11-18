<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Entities\Layout;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Auth;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = '/';
    private $layout;


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->layout = getConfig('general', 'layout') ?? 1;
    }


    public function show()
    {
        if (!empty(Auth::user()->email_verified_at)) return redirect(url(route('front.user.edit')));

        return view('Theme::modules.users.verify', [
            'blocks' => Layout::findOrFail($this->layout)->getLayout()
        ]);
    }
}
