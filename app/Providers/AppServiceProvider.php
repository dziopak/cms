<?php

namespace App\Providers;

use App\Console\Commands\ModelMakeCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Hook;

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
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Entities\User::observe(\App\Observers\UserObserver::class);
        \App\Entities\Page::observe(\App\Observers\PageObserver::class);
        \App\Entities\Post::observe(\App\Observers\PostObserver::class);
        \App\Entities\Role::observe(\App\Observers\RoleObserver::class);
        \App\Entities\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Entities\Layout::observe(\App\Observers\LayoutObserver::class);

        \App\Entities\Carousel::observe(\App\Observers\CarouselObserver::class);
        \App\Entities\Slider::observe(\App\Observers\SliderObserver::class);
        \App\Entities\Menu::observe(\App\Observers\MenuObserver::class);

        Paginator::useBootstrap();
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });
    }
}
