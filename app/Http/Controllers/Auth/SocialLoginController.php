<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Auth;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        $users = User::where([
            'email' => $userSocial->getEmail(),
        ])->first();
        if ($users) {
            Auth::login($users);
            return redirect('/');
        } else {
            $users = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'provider_id' => $userSocial->getId(),
                'provider' => $provider,
            ]);
            Auth::login($users);
            return redirect(url('/'));
        }
    }
}
