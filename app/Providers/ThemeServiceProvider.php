<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;

class ThemeServiceProvider extends ServiceProvider
{

    private function registerNamespaces($slug)
    {
        $basePath = str_replace('\\', '/', base_path("resources/themes/" . $slug));

        $this->loadViewsFrom($basePath, 'Theme');
        $this->loadViewsFrom($basePath . '/partials', 'Partial');
        \App::make('translator')->addNamespace('Theme', $basePath . '/lang');
    }


    private function getSiteDetails()
    {
        $site = (object) [
            'full_title' => config('global.general.title') . ' - ' . config('global.general.description'),
            'title' => config('global.general.title'),
            'description' => config('global.general.description')
        ];

        return $site;
    }


    public function boot()
    {

        if (is_installed()) {
            $theme = (new ThemeHelpers);
            $theme->data = $theme->getThemeData();
            $this->registerNamespaces($theme->data->slug);

            view()->composer('Theme::*', function ($view) use ($theme) {
                $view->with('theme', $theme);
                $view->with('site', $this->getSiteDetails());
            });
        }
    }
}
