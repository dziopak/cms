<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class PostsComposers extends ServiceProvider
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
        view()->composer('admin.posts.index', function ($view) use ($request) {
            $view->posts = \App\Post::with('author', 'thumbnail')->orderByDesc('id')->filter($request)->paginate(15);
            $view->table = getData('Admin/posts/posts_index_table');
        });


        view()->composer('admin.posts.create', function ($view) {
            $categories = array_merge(['No category'], \App\PostCategory::list_all());
            $view->form = getData('Admin/posts/posts_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null)]);
        });


        view()->composer('admin.posts.edit', function ($view) {
            $categories = array_merge(['No category'], \App\PostCategory::list_all());
            $view->post = \App\Post::with('thumbnail')->findOrFail($view->post_id);
            $view->form = getData('Admin/posts/posts_form', ['categories' => $categories, 'thumbnail' => getThumbnail($view->post->thumbnail)]);
        });
    }
}
