<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\Admin\DashboardUtilities;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard.index', ['user' => Auth::user(), 'dashboard' => Auth::user()->dashboard]);
    }

    public function getWidget(Request $request) {
        return DashboardUtilities::getWidget($request);
    }

    public function update(Request $request) {
        return DashboardUtilities::update($request);
    }
}
