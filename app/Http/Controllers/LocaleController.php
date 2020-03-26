<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LocaleController extends Controller
{
    public function __invoke(Request $request) {
        
        Auth::user()->locale = $request->get('lang');
        Auth::user()->save();

        session(['locale' => $request->get('lang')]);
        
        return redirect()->back();
    }
}
