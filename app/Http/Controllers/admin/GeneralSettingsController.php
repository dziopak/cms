<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Setting;
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
        $data = $request->except('_token');
        \DB::transaction(function () use ($data) {
            foreach ($data as $setting => $value) {
                \DB::table('settings')->updateOrInsert([
                    'name' => $setting
                ], [
                    'name' => $setting,
                    'value' => $value,
                    'group' => 'general',
                ]);
            }
        });

        return redirect()->back();
    }
}
