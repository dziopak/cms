<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;
use stdClass;
use Illuminate\Support\Facades\Blade;

class FrontViewServiceProvider extends ServiceProvider
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
    public function boot()
    {

        if (is_installed()) {
            // Theme data
            $theme = (new ThemeHelpers);
            $theme->data = $theme->getThemeData();

            $site = new stdClass();
            $site->full_title = config('global.general.title') . ' - ' . config('global.general.description');
            $site->title = config('global.general.title');
            $site->description = config('global.general.description');

            view()->composer($theme->data->url . '/*', function ($view) use ($theme, $site) {
                $view->with('theme', $theme);
                $view->with('site', $site);
            });

            Blade::include('themes.' . $theme->data->slug . '.blocks.header.index', 'header');
            Blade::include('themes.' . $theme->data->slug . '.blocks.footer.index', 'footer');
        }
    }
}
