<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Support\ServiceProvider;

class MediaComposers extends ServiceProvider
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

        view()->composer('admin.media.index', function ($view) use ($request) {
            $view->files = \App\File::filter($request)->paginate(15);
            $view->table = getData('admin/media/media_index_table');
        });

        view()->composer('admin.media.partials.list', function ($view) use ($request) {
            if (empty($view->files)) {
                $view->files = \App\File::filter($request)->get();
                $view->table = getData('admin/media/media_index_table');
            }
        });

        view()->composer('admin.media.edit', function ($view) use ($request) {
            $file = \App\File::findOrFail($view->file->id);
            $view->form = getData('admin/media/media_edit_form');
            $view->file = $file;
        });
    }
}
