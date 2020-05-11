<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;

class PluginsController extends Controller
{
    public function index()
    {
        return view('admin.plugins.index');
    }
}
