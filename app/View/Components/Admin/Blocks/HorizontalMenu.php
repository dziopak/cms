<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;
use App\Entities\Menu;

class HorizontalMenu extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 12,
        'min-w' => '12',
        'min-h' => '1',
        'auto' => true,
        'header' => 'Horizontal Menu',
        'x' => 0,
        'y' => 0,
        'non-resizeable' => true,
        'id' => 'horizontal-menu-block'
    ];


    public function __construct($block, $admin = false, $exists = false)
    {
        if ($block) {
            if (!empty($block->x)) $this->config['x'] = $block->x;
            if (!empty($block->y)) $this->config['y'] = $block->y;
            if (!empty($block->width)) $this->config['w'] = $block->width;
            if (!empty($block->height)) $this->config['h'] = $block->height;
            if (!empty($block->auto)) $this->config['auto'] = $block->auto;
            $this->config['block'] = $block;
        }
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
    }


    public function render()
    {
        $this->config = decodeBlockConfig($this->config);

        $menu = Menu::find($this->config['block']->config['menu_id'] ?? 1);
        $menu_list = Menu::all()->pluck('name', 'id')->toArray();

        if (!$this->config['is_admin'])
            $items = $menu->items()
                ->where(['parent' => 0])
                ->get()
                ->map(function ($item) {
                    if ($item->model_id && $item->model_type) {
                        $item->link = getModel($item->model_type)::findOrFail($item->model_id)->getUrl();
                    }
                    return $item;
                });

        return block('horizontal_menu', $this->config, ['menus' => $menu_list ?? []], ['menu' => $items ?? null]);
    }
}
