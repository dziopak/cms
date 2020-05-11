<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function registerConfig()
    {
        if (is_installed() && db_set()) {
            if (table_exists('settings')) {
                $settings = \App\Setting::all([
                    'name', 'value', 'group'
                ])->groupBy('group', true)->transform(function ($setting) {
                    $settings = $setting->toArray();
                    $result = [];

                    foreach ($settings as $setting) {
                        $result[$setting['name']] = $setting['value'];
                    }

                    return $result;
                });

                config([
                    'global' => $settings
                ]);
            }
        }
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }
}
