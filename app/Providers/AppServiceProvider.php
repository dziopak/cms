<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;

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
