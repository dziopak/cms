<?php

namespace App\Http\Utilities\Admin;

class SettingsUtilities
{
    public static function generalSettingsStore($request)
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
