<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dashboard;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        $dash = Auth::user()->dashboard;
        if (!$dash) {
            $dash = Dashboard::create(['user_id' => Auth::user()->id]);
        }
        $widgets = unserialize($dash->widgets);
        return view('admin.dashboard.index', compact('widgets'));
    }

    public function edit() {
        $dash = Auth::user()->dashboard;
        if (!$dash) {
            $dash = Dashboard::create(['user_id' => Auth::user()->id]);
        }
        $widgets = unserialize($dash->widgets);
        return view('admin.dashboard.edit', compact('widgets'));
    }

    public function update(Request $request) {
        $dash = Auth::user()->dashboard;
        $widgets = json_decode($request->get('widgets'), true);
        // dd($widgets);
        $dash->update([
            'widgets' => serialize($widgets)
        ]);
        return redirect(route('admin.dashboard.index'));
    }
}
