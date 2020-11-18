<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

use Exception;

use App\Entities\Block;

class LayoutBlocks
{
    static function updateBlocks($layout, $request)
    {
        $data = $request->except(['_token', 'result']);
        $json = json_decode($request->get('result'), true);
        $blocks = $request->get('config');

        $layout->blocks()->delete();

        foreach ($json as $block) {
            $config = $blocks[$block['key']];
            $title = $config['title'] ?? "Untitled";
            $container = filter_var($config['container'], FILTER_VALIDATE_BOOLEAN);

            unset($config['title']);
            unset($config['container']);

            Block::updateOrCreate(['id' => $block['id']], [
                'title' => $title,
                'container' => $container,
                'config' => serialize($config ?? []),
                'type' => explode('-block', $block['type'])[0],
                'x' => $block['x'],
                'y' => $block['y'],
                'width' => $block['w'],
                'height' => $block['h'],
                'layout_id' => $layout->id
            ]);
        }
    }

    static function getBlock($request)
    {
        if (empty($request->get('name'))) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $name = camelCase($request->get('name'));
            $name = 'App\View\Components\Admin\Blocks\\' . ucfirst($name);
            $block = (object) [
                'id' => $request->get('name'),
                'x' => 0,
                'y' => 0,
                'auto' => true
            ];
            $widget = new $name($block, true);
            $widget = $widget->render();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }
}
