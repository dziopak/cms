<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Interfaces\Repositories\CarouselRepositoryInterface::class, \App\Repositories\CarouselRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\CategoryRepositoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\FileRepositoryInterface::class, \App\Repositories\FileRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\LayoutRepositoryInterface::class, \App\Repositories\LayoutRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\MenuRepositoryInterface::class, \App\Repositories\MenuRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\PageRepositoryInterface::class, \App\Repositories\PageRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\PostRepositoryInterface::class, \App\Repositories\PostRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\RoleRepositoryInterface::class, \App\Repositories\RoleRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\SettingRepositoryInterface::class, \App\Repositories\SettingRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\SliderRepositoryInterface::class, \App\Repositories\SliderRepository::class);
        $this->app->bind(\App\Interfaces\Repositories\UserRepositoryInterface::class, \App\Repositories\UserRepository::class);
    }
}
