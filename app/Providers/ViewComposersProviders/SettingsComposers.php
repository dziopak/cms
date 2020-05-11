<?php

namespace App\Providers\ViewComposersProviders;

use App\Helpers\ThemeHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class SettingsComposers extends ServiceProvider
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

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        view()->composer('admin.settings.general', function ($view) {
            $themes = ThemeHelpers::getThemeList();
            $view->settings = \App\Setting::where(['group' => 'general'])->pluck('value', 'name')->toArray();
            $view->form = getData('Admin/Modules/settings/general', array_merge($view->settings, ['themes' => $themes]));
        });


        view()->composer('admin.logs.index', function ($view) {
            $view->logs = \App\Log::with('author')->orderBy('logs.id', 'desc')->get();
        });
    }
}
