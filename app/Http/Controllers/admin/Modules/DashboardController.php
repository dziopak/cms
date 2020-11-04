<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\Admin\Modules\Dashboards\DashboardEntity;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'user' => Auth::user(),
            'dashboard' => Auth::user()->dashboard,
            'prefix' => 'admin.widgets.'
        ]);
    }

    public function getWidget(Request $request)
    {
        return DashboardEntity::getWidget($request);
    }

    public function update(Request $request)
    {
        return DashboardEntity::update($request);
    }
}
