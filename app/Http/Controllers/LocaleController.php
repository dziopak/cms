<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LocaleController extends Controller
{
    public function __invoke(Request $request)
    {
        setLang($request->get('lang'));
        return redirect()->back();
    }
}
