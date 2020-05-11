<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class PagesComposers extends ServiceProvider
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
    public function boot(Request $request)
    {
        view()->composer('admin.pages.index', function ($view) use ($request) {
            $view->pages = \App\Page::with('author', 'thumbnail')->orderByDesc('id')->filter($request)->paginate(15);
            $view->table = getData('Admin/Modules/pages/pages_index_table');
        });


        view()->composer('admin.pages.create', function ($view) {
            $categories = array_merge(['No category'], \App\PageCategory::list_all());
            $layouts = \App\Layout::list();

            $view->form = getData('Admin/Modules/pages/pages_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null), 'layouts' => $layouts ?? [0 => 'none']]);
        });


        view()->composer('admin.pages.edit', function ($view) {
            $page = \App\Page::with('thumbnail')->findOrFail($view->page_id);
            $categories = array_merge(['No category'], \App\PageCategory::list_all());
            $layouts = \App\Layout::list();

            $view->form = getData('Admin/Modules/pages/pages_form', ['categories' => $categories, 'thumbnail' => getThumbnail($page->thumbnail), 'layouts' => $layouts ?? [0 => 'none']]);
            $view->page = $page;
        });
    }
}
