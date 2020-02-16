<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogsController extends Controller
{
    public function index() {
        $logs = Log::orderBy('created_at', 'desc')->get();
        return view('admin.logs.index', compact('logs'));
    }
}
