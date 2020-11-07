<?php

namespace App\Http\Utilities\Admin\Modules\Dashboards;

use Exception;
use Widget;
use Auth;

class DashboardEntity
{
    public static function getWidget($request)
    {

        if (empty($request->get('name'))) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $name = camelCase($request->get('name'));
            $name = 'App\View\Components\Admin\Widgets\\' . ucfirst($name);
            $block = [
                'id' => $request->get('name'),
                'x' => 0,
                'y' => 0,
                'auto' => true,
                'w' => 1,
                'h' => 1
            ];
            $widget = new $name($block, true);
            $widget = $widget->render();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }


    public static function update($request)
    {
        $items = $request->get('items');
        Auth::user()->dashboard->update(['widgets' => serialize($items ?? [])]);

        return response()->json(['success' => true], 200);
    }
}
