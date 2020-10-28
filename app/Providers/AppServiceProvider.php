<?php

namespace App\Providers;

use App\Console\Commands\ModelMakeCommand;
use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->view->composers([
            'App\Composers\Admin\CategoriesComposer' => 'admin.*_categories.*',
            'App\Composers\Admin\PostsComposer' => 'admin.posts.*',
            'App\Composers\Admin\PagesComposer' => 'admin.pages.*',
            'App\Composers\Admin\UsersComposer' => 'admin.users.*',
            'App\Composers\Admin\RolesComposer' => 'admin.roles.*',
            'App\Composers\Admin\DashboardComposer' => 'admin.dashboard.*',
            'App\Composers\Admin\MediaComposer' => 'admin.media.*',
            'App\Composers\Admin\Blocks\MenusComposer' => 'admin.blocks.menus.*',
            'App\Composers\Admin\Blocks\SlidersComposer' => 'admin.blocks.sliders.*',
            'App\Composers\Admin\PluginsComposer' => 'admin.plugins.*',
        ]);
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrap();
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });

        view()->composer('admin.settings.general', function ($view) {
            $themes = ThemeHelpers::getThemeList();
            $view->settings = \App\Entities\Setting::where(['group' => 'general'])->pluck('value', 'name')->toArray();
            $view->form = getData('Admin/Modules/settings/general', array_merge($view->settings, ['themes' => $themes]));
        });


        view()->composer('admin.logs.index', function ($view) {
            $view->logs = \App\Entities\Log::with('author')->orderBy('logs.id', 'desc')->get();
        });
    }
}
