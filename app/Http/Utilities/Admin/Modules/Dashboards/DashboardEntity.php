<?php

namespace App\Http\Utilities\Admin\Modules\Dashboards;

use Exception;
use Widget;
use Auth;

class DashboardEntity
{
    public static function getWidget($request)
    {
        $widget = $request->get('name');
        if (empty($widget)) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $widget = Widget::run('dashboard.' . $widget);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }


    public static function update($request)
    {
        $items = $request->get('items');
        $dashboard = Auth::user()->dashboard;

        if (is_array($items)) {
            $dashboard->update(['widgets' => serialize($items)]);
            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false], 400);
    }
}
