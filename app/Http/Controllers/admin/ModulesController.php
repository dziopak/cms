<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Nwidart\Modules\Facades\Module;

class ModulesController extends Controller
{
    public function index()
    {
        return view('admin.modules.index');
    }
}
