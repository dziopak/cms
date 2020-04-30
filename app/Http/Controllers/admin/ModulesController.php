<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ModulesController extends Controller
{
    public function index()
    {
        return view('admin.modules.index');
    }
}
