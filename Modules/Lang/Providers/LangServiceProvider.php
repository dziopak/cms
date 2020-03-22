<?php

namespace Modules\Lang\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Hook;
use Modules\Lang\Entities\Lang;

class LangServiceProvider extends ServiceProvider
{
    
    public function registerHooks() {
        $langs = Lang::all();
        
        require('Hooks/posts.hooks.php');
        require('Hooks/pages.hooks.php');
        require('Hooks/categories.hooks.php');
        require('Hooks/modules/testimonials.hooks.php');
        require('Hooks/modules/portfolio.hooks.php');

        // <i class="fas fa-globe-europe"></i>

        Hook::listen('adminSidebarItems', function ($callback, $output, $items) {
            if (empty($output))
            {
              $output = $items;
            }

            $output['settings']['items']['lang'] = [
                'route' => 'admin.modules.lang.index',
                'custom_label' => __('lang::admin/langs.lang_settings')
            ];

            return $output;
        }, 10);
        
        Hook::listen('template.top-nav-user-bar', function ($callback, $output, $variables) use ($langs) {
            !empty(session('lang')) ? $current_lang = session('lang') : $current_lang = 'en';
            foreach($langs as $key => $lang) {
                $tmp_langs[$lang->lang_tag] = $lang->name;
            }
            $langs = array_merge(['en' => "English"], $tmp_langs);
            return view('lang::partials.lang-switcher', compact('langs', 'current_lang'));
        });
    }

    public function boot()
    {
        $this->registerHooks();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Lang', 'Database/Migrations'));
    }

    
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Lang', 'Config/config.php') => config_path('lang.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Lang', 'Config/config.php'), 'lang'
        );
    }

    
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/lang');

        $sourcePath = module_path('Lang', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

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
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Lang', 'Database/factories'));
        }
    }

    
    public function provides()
    {
        return [];
    }
}
