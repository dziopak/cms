<?php

namespace App\Plugins\Lang\Providers;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class LangRouteServiceProvider extends RouteServiceProvider
{


    protected $langNamespace = 'App\Plugins\Lang\Controllers';

    public function boot()
    {
        parent::boot();
        $this->loadViewsFrom(base_path("app/Plugins/Lang/Views"), 'Lang');
    }


    protected function mapWebRoutes()
    {
        foreach (glob(base_path('app/Plugins/Lang/routes/*.php')) as $file) {
            Route::middleware(['web', 'guest:api'])
                ->as('Lang::')
                ->namespace($this->langNamespace)
                ->group($file);
        }
    }


    public function map()
    {
        $this->mapWebRoutes();
    }
}
