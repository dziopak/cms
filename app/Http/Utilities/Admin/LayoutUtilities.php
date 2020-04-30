<?php

namespace App\Http\Utilities\Admin;

use App\Layout;
use App\Block;
use Auth;

class LayoutUtilities extends \App\Http\Utilities\LayoutUtilities
{

    static function updateBlocks($layout_id, $request)
    {
        $json = json_decode($request->get('result'), true);

        foreach ($json as $block) {
            Block::updateOrCreate(['id' => $block['id']], [
                'title' => $block['config']['title'] ?? "Untitled",
                'config' => serialize($block['config'] ?? []),
                'type' => explode('-block', $block['type'])[0],
                'x' => $block['x'],
                'y' => $block['y'],
                'width' => $block['w'],
                'height' => $block['h'],
                'layout_id' => $layout_id
            ]);
        }
    }


    public static function store($request)
    {
        $data = $request->except('config', '_token', 'result');
        $layout = Layout::create([
            'name' => $data['name'],
        ]);

        LayoutUtilities::updateBlocks($layout->id, $request);

        return redirect(route('admin.pages.layouts.index'))->with('crud', 'Layout created successfully.');
    }


    public static function update($id, $request)
    {
        $layout = Layout::findOrFail($id);
        $layout->blocks()->delete();
        $data = $request->except(['_token', 'result']);

        LayoutUtilities::updateBlocks($layout->id, $request);

        Layout::findOrFail($id)->update([
            "name" => $data['name'],
        ]);

        return redirect(route('admin.pages.layouts.index'))->with('crud', 'Layout updated successfully.');
    }
}
