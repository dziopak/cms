<?php

namespace Modules\UserCustomFields\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Hook;

class UserCustomFieldsServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        include('HooksProvider.php');
        

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('UserCustomFields', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('UserCustomFields', 'Config/config.php') => config_path('usercustomfields.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('UserCustomFields', 'Config/config.php'), 'usercustomfields'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/usercustomfields');

        $sourcePath = module_path('UserCustomFields', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/usercustomfields';
        }, \Config::get('view.paths')), [$sourcePath]), 'usercustomfields');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/usercustomfields');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'usercustomfields');
        } else {
            $this->loadTranslationsFrom(module_path('UserCustomFields', 'Resources/lang'), 'usercustomfields');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('UserCustomFields', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
