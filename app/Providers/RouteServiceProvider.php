<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
        Route::model('role_id', \App\Entities\Role::class);
        Route::model('media', \App\Entities\File::class);
        Route::model('media_id', \App\Entities\File::class);
        Route::model('file_id', \App\Entities\File::class);
    }


    public function map()
    {
        $this->mapAdminRoutes();
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapFrontRoutes();
    }


    protected function mapFrontRoutes()
    {
        foreach (glob(base_path('routes/web/front/*.php')) as $file) {
            Route::middleware(['web', 'guest:api'])
                ->as('front.')
                ->namespace($this->namespace)
                ->group($file);
        }
    }


    protected function mapAdminRoutes()
    {
        $files = array_merge(
            glob(base_path('routes/web/admin/modules/*.php')),
            glob(base_path('routes/web/admin/blocks/*.php'))
        );

        foreach ($files as $file) {
            Route::middleware(['web', 'access:ADMIN_VIEW'])
                ->prefix('admin')
                ->as('admin.')
                ->namespace($this->namespace)
                ->group($file);
        }
    }


    protected function mapWebRoutes()
    {
        foreach (glob(base_path('routes/web/*.php')) as $file) {
            Route::middleware(['web'])
                ->namespace($this->namespace)
                ->group($file);
        }
    }


    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
