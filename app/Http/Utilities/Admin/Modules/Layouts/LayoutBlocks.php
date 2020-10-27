<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

use App\Entities\Block;

class LayoutBlocks
{
    static function updateBlocks($layout, $request)
    {
        $data = $request->except(['_token', 'result']);
        $json = json_decode($request->get('result'), true);

        $layout->blocks()->delete();

        foreach ($json as $block) {
            $title = $block['config']['title'] ?? "Untitled";
            $container = filter_var($block['config']['container'], FILTER_VALIDATE_BOOLEAN);

            unset($block['config']['title']);
            unset($block['config']['container']);

            Block::updateOrCreate(['id' => $block['id']], [
                'title' => $title,
                'container' => $container,
                'config' => serialize($block['config'] ?? []),
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
