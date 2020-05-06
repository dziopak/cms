<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class CategoriesComposers extends ServiceProvider
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
        view()->composer('admin.post_categories.index', function ($view) use ($request) {
            $view->categories = \App\PostCategory::orderByDesc('id')->filter($request)->paginate(15);
            $view->table = getData('Admin/categories/post_categories_index_table');
        });


        view()->composer('admin.post_categories.create', function ($view) {
            $categories = array_merge([__('admin/post_categories.no_category')], \App\PostCategory::list_all());
            $view->form = getData('Admin/categories/post_categories_form', ['categories' => $categories]);
        });


        view()->composer('admin.post_categories.edit', function ($view) {
            $view->categories = array_merge([__('admin/post_categories.no_category')], \App\PostCategory::list_all());
            $view->category = \App\PostCategory::findOrFail($view->category_id);
            $view->form = getData('Admin/categories/post_categories_form', ['categories' => $view->categories]);
        });


        view()->composer('admin.page_categories.index', function ($view) use ($request) {
            $view->categories = \App\PageCategory::orderByDesc('id')->filter($request)->paginate(15);
            $view->table = getData('Admin/categories/page_categories_index_table');
        });


        view()->composer('admin.page_categories.create', function ($view) {
            $categories = array_merge([__('admin/page_categories.no_category')], \App\PageCategory::list_all());
            $view->form = getData('Admin/categories/page_categories_form', ['categories' => $categories]);
        });


        view()->composer('admin.page_categories.edit', function ($view) {
            $categories = array_merge([__('admin/page_categories.no_category')], \App\PageCategory::list_all());
            $view->category = \App\PageCategory::findOrFail($view->category_id);
            $view->form = getData('Admin/categories/page_categories_form', ['categories' => $categories]);
        });
    }
}
