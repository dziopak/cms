<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Log;

class LogsController extends Controller
{
    public function index() {
        $logs = Log::with('author')->orderBy('logs.id', 'desc')->get();
        return view('admin.logs.index', compact('logs'));
    }
}