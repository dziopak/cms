<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class ModulesController extends Controller
{
    public function index()
    {
        return view('admin.modules.index');
    }
}
