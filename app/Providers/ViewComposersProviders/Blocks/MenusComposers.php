<?php

namespace App\Providers\ViewComposersProviders\Blocks;

use Illuminate\Support\ServiceProvider;

class MenusComposers extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $request = request();

        view()->composer('admin.blocks.menus.index', function ($view) {
            $view->menus = \App\Menu::paginate(15);
            $view->table = getData('Admin/Blocks/menus/menus_index_table');
        });

        view()->composer('admin.blocks.menus.edit', function ($view) use ($request) {
            $view->menu = \App\Menu::with('items')->findOrFail($request->route('menu'));

            $view->item_types = [
                'url' => 'URL',
                'entries' => 'Entries'
            ];
        });
    }
}
