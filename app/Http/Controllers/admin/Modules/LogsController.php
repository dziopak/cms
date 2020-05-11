<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    public function index()
    {
        return view('admin.logs.index');
    }
}
