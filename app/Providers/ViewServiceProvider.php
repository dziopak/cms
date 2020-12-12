<?php

namespace App\Providers;

use App\Entities\Layout;
use Illuminate\Support\ServiceProvider;
use App\Helpers\ThemeHelpers;
use App\Entities\File;
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
            'App\View\Composers\Admin\Modules\LayoutsComposer' => 'admin.layouts.*',
            'App\View\Composers\Admin\Modules\UsersComposer' => 'admin.users.*',
            'App\View\Composers\Admin\Modules\DashboardComposer' => 'admin.dashboard.*',
            'App\View\Composers\Admin\Modules\MediaComposer' => 'admin.media.*',
            'App\View\Composers\Admin\Modules\PluginsComposer' => 'admin.plugins.*',
            'App\View\Composers\Admin\Blocks\MenusComposer' => 'admin.menus.*',
            'App\View\Composers\Admin\Blocks\SlidersComposer' => 'admin.sliders.*',
            'App\View\Composers\Admin\Blocks\CarouselsComposer' => 'admin.carousels.*',
        ]);

        view()->composer('admin.settings.general', function ($view) {
            $themes = ThemeHelpers::getThemeList();
            $layouts = Layout::all()->pluck('name', 'id');

            $view->settings = \App\Entities\Setting::where(['group' => 'general'])->pluck('value', 'name')->toArray();
            $view->form = getData('Admin/Modules/Settings/general', array_merge($view->settings, ['themes' => $themes, 'layouts' => $layouts]));
        });

        view()->composer('admin.settings.content', function ($view) {
            $layouts = Layout::all()->pluck('name', 'id');

            $view->settings = \App\Entities\Setting::where(['group' => 'content'])->pluck('value', 'name')->toArray();
            $view->form = getData('Admin/Modules/Settings/content', array_merge($view->settings, ['layouts' => $layouts]));
        });

        view()->composer('admin.logs.index', function ($view) {
            $view->logs = \App\Entities\Log::with('author')->orderBy('logs.id', 'desc')->get();
        });

        view()->composer('admin.partials.massedit.category', function ($view) {
            $view->categories = \App\Entities\Category::list();
        });
    }
}
