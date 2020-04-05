<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    public function index() {
        
        return view('admin.logs.index');
    }
}