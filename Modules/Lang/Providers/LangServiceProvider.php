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
        
        Hook::listen('template.adminStylesheets', function ($callback, $output, $variables){
            $html = '<link href="'.asset('public/css/lang.css').'" rel="stylesheet">';        
            !empty($output) ? $output .= $html : $output = $html;
            return $output;
        });
    
        Hook::listen('template.adminScriptsDefer', function ($callback, $output, $variables){
            $html = '<script src="'.asset('js/langs.js').'"></script>';        
            !empty($output) ? $output .= $html : $output = $html;
            return $output;
        });

        Hook::listen('template.adminInlineScripts', function ($callback, $output, $variables) use ($langs) {
            $html = '<div class="input-lang-switcher">';
            $html .= '<div class="input-lang active" style="background-image: url(\'/images/langs/flags/en.png\');" data-lang="default"></div>';
            foreach($langs as $lang) {
                $html .= '<div style="background-image: url(\'/images/langs/flags/'.$lang->lang_tag.'.png\');" class="input-lang" data-lang="'.$lang->lang_tag.'"></div>';
            }
            $html .= '</div>';
            $script = '
                $(document).ready(function() {
                    var fields = $(".lang_origin");
    
                    if (fields.length > 0) {
                        fields.each(function() {
                            $(this).append(`'.$html.'`);
                        });
                    }
                });
            ';        
            !empty($output) ? $output .= $script : $output = $script;
            return $output;
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
