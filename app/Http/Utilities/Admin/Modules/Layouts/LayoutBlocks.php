<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

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
}
