<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Admin\SettingsUtilities;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    /**
     * Display settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.general');
    }

    /**
     * Save settings in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return SettingsUtilities::GeneralSettingsStore($request);
    }
}
