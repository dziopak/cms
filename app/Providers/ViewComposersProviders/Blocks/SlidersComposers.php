<?php

namespace App\Providers\ViewComposersProviders\Blocks;

use Illuminate\Support\ServiceProvider;

class SlidersComposers extends ServiceProvider
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

        view()->composer('admin.blocks.sliders.index', function ($view) {
            $view->sliders = \App\Slider::paginate(15);
            $view->table = getData('Admin/blocks/sliders/sliders_index_table');
        });
    }
}
