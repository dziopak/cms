<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Nwidart\Modules\Facades\Module;

class ModulesController extends Controller
{
    private function ModulesToArray($modules) {
        $res = [];
        foreach($modules as $module) {
            $res[] = $module->getName();
        }
        return $res;
    }
    
    public function index()
    {
        Module::boot();
        $modules['active'] = \App\Module::getModulesData($this->ModulesToArray(Module::allEnabled()));
        $modules['inactive'] = \App\Module::getModulesData($this->ModulesToArray(Module::allDisabled()));

        $table = getData('admin/modules/modules_index_table');
        return view('admin.modules.index', compact('modules', 'table'));
    }
}
