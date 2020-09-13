<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Nwidart\Modules\Facades\Module;

class PluginsController extends Controller
{
    public function index()
    {
        return view('admin.plugins.index');
    }

    public function disable($slug)
    {
        Module::find($slug)->disable();
        return redirect()->back()->with('crud', 'Plugin disabled successfully');
    }

    public function enable($slug)
    {
        Module::find($slug)->enable();
        return redirect()->back()->with('crud', 'Plugin enabled successfully');
    }
}
