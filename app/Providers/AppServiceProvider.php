<?php

namespace App\Providers;

use App\Console\Commands\ModelMakeCommand;
use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;
use Illuminate\Pagination\Paginator;
use App\Entities\Role;
use View;

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

        View::composer('admin.partials.massedit.user_role', function ($view) {
            $view->with('roles', Role::all('id', 'name')->pluck('name', 'id'));
        });

        $this->app->view->composers([
            'App\View\Composers\Admin\CategoriesComposer' => 'admin.*_categories.*',
            'App\View\Composers\Admin\PostsComposer' => 'admin.posts.*',
            'App\View\Composers\Admin\PagesComposer' => 'admin.pages.*',
            'App\View\Composers\Admin\UsersComposer' => 'admin.users.*',
            'App\View\Composers\Admin\RolesComposer' => 'admin.roles.*',
            'App\View\Composers\Admin\DashboardComposer' => 'admin.dashboard.*',
            'App\View\Composers\Admin\MediaComposer' => 'admin.media.*',
            'App\View\Composers\Admin\Blocks\MenusComposer' => 'admin.blocks.menus.*',
            'App\View\Composers\Admin\Blocks\SlidersComposer' => 'admin.blocks.sliders.*',
            'App\View\Composers\Admin\PluginsComposer' => 'admin.plugins.*',
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
