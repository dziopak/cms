<?php

namespace App\Providers\ViewComposersProviders;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class ModulesComposers extends ServiceProvider
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

    
    private function ModulesToArray($modules) {
        $res = [];
        foreach($modules as $module) {
            $res[] = $module->getName();
        }
        return $res;
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        view()->composer('admin.modules.index', function ($view) {
            Module::boot();
            $modules['active'] = \App\Module::getModulesData($this->ModulesToArray(Module::allEnabled()));
            $modules['inactive'] = \App\Module::getModulesData($this->ModulesToArray(Module::allDisabled()));
            
            $view->modules = $modules;
            $view->table = getData('admin/modules/modules_index_table');
        });
    }
}
