<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Admin\SettingsUtilities;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        return view('admin.settings.general');
    }


    public function store(Request $request)
    {
        return SettingsUtilities::GeneralSettingsStore($request);
    }
}
