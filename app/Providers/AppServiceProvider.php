<?php

namespace App\Providers;

use App\Console\Commands\ModelMakeCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;

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
        \App\Entities\PostCategory::observe(\App\Observers\CategoryObserver::class);
        \App\Entities\PageCategory::observe(\App\Observers\CategoryObserver::class);
        \App\Entities\Carousel::observe(\App\Observers\CarouselObserver::class);

        Paginator::useBootstrap();
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });
    }
}
