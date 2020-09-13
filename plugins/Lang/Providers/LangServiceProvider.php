<?php

namespace plugins\Lang\Providers;

use App\Http\Utilities\Admin\PluginUtilities;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use plugins\Lang\Entities\Lang;
use plugins\Lang\Providers\HooksServiceProvider;

class LangServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if (is_installed() && table_exists('langs')) {
            PluginUtilities::registerPlugin('lang');
            $this->registerTranslations();
            $this->registerConfig();
            $this->registerViews();
            $this->registerFactories();
        }
        $this->loadMigrationsFrom(module_path('Lang', 'Database/Migrations'));
    }


    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(HooksServiceProvider::class);
    }


    protected function registerConfig()
    {
        $this->publishes([
            module_path('Lang', 'Config/config.php') => config_path('lang.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Lang', 'Config/config.php'),
            'lang'
        );
    }


    public function registerViews()
    {
        $viewPath = resource_path('views/modules/lang');

        $sourcePath = module_path('Lang', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/lang';
        }, \Config::get('view.paths')), [$sourcePath]), 'lang');
    }


    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/lang');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'lang');
        } else {
            $this->loadTranslationsFrom(module_path('Lang', 'Resources/lang'), 'lang');
        }
    }


    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Lang', 'Database/factories'));
        }
    }


    public function provides()
    {
        return [];
    }
}
