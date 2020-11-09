<?php

namespace App\Http\Utilities\Admin;

class SettingsUtilities
{
    public static function settingsStore($request, $group)
    {
        $data = $request->except('_token');
        \DB::transaction(function () use ($data, $group) {
            foreach ($data as $setting => $value) {
                \DB::table('settings')->updateOrInsert([
                    'name' => $setting
                ], [
                    'name' => $setting,
                    'value' => $value,
                    'group' => $group,
                ]);
            }
        });

        return redirect()->back();
    }
}
