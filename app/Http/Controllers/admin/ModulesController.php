<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Hook;

class ModulesController extends Controller
{
    public function index()
    {
        Module::boot();
        $modules['active'] = Module::allEnabled();
        $modules['inactive'] = Module::allDisabled();
        
        return view('admin.modules.index', compact('modules'));
    }
}
