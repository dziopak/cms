<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dashboard;
use Auth;
use Widget;
use App\Widgets\admin\RecentPosts;
use Exception;

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

    public function getWidget(Request $request) {
        $widget = $request->get('name');
        if (empty($widget)) return response()->json('URL parameter "name" is missing.', 404);
        
        try {
            $widget = Widget::run('admin.'.$widget);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }
        
        return response()->json((string) $widget, 200);
    }

    public function update(Request $request) {
        $items = $request->get('items');
        $dashboard = Auth::user()->dashboard;

        if (is_array($items)) {
            $dashboard->update(['widgets' => serialize($items)]);
            return response()->json(['success' => true], 200); 
        }
        
        return response()->json(['success' => false], 400); 
    }
}
