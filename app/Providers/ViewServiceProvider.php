<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;
use View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('admin.partials.massedit.user_role', function ($view) {
            $view->with('roles', \App\Entities\Role::all('id', 'name')->pluck('name', 'id'));
        });

        $this->app->view->composers([
            'App\View\Composers\Admin\Modules\CategoriesComposer' => 'admin.*_categories.*',
            'App\View\Composers\Admin\Modules\PostsComposer' => 'admin.posts.*',
            'App\View\Composers\Admin\Modules\PagesComposer' => 'admin.pages.*',
            'App\View\Composers\Admin\Modules\UsersComposer' => 'admin.users.*',
            'App\View\Composers\Admin\Modules\RolesComposer' => 'admin.roles.*',
            'App\View\Composers\Admin\Modules\DashboardComposer' => 'admin.dashboard.*',
            'App\View\Composers\Admin\Modules\MediaComposer' => 'admin.media.*',
            'App\View\Composers\Admin\Modules\Blocks\MenusComposer' => 'admin.blocks.menus.*',
            'App\View\Composers\Admin\Modules\Blocks\SlidersComposer' => 'admin.blocks.sliders.*',
            'App\View\Composers\Admin\Modules\PluginsComposer' => 'admin.plugins.*',
        ]);

        view()->composer('admin.settings.general', function ($view) {
            $themes = ThemeHelpers::getThemeList();
            $view->settings = \App\Entities\Setting::where(['group' => 'general'])->pluck('value', 'name')->toArray();
            $view->form = getData('Admin/Modules/settings/general', array_merge($view->settings, ['themes' => $themes]));
        });


        view()->composer('admin.logs.index', function ($view) {
            $view->logs = \App\Entities\Log::with('author')->orderBy('logs.id', 'desc')->get();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
