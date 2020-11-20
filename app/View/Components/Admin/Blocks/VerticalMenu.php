<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;
use App\Entities\Menu;

class VerticalMenu extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 3,
        'max-height' => '1',
        'max-width' => '3',
        'auto' => true,
        'min-w' => '3',
        'min-h' => '1',
        'header' => 'Vertical menu',
        'x' => 0,
        'y' => 0,
        'non-resizeable' => false,
        'id' => 'vertical-menu-block'
    ];


    // TO DO //
    // READ FROM THEME //
    private $styles = [
        0 => 'Default',
        1 => 'Style #1',
        2 => 'Style #2'
    ];


    public function __construct($block, $admin = false, $exists = false)
    {
        if ($block) {
            if (!empty($block->x)) $this->config['x'] = $block->x;
            if (!empty($block->y)) $this->config['y'] = $block->y;
            if (!empty($block->width)) $this->config['w'] = $block->width;
            if (!empty($block->height)) $this->config['h'] = $block->height;
            if (!empty($block->auto)) $this->config['auto'] = false;
            $this->config['block'] = $block;
        }
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
    }


    public function render()
    {
        $this->config = decodeBlockConfig($this->config);

        $menu = Menu::find($this->config['block']->config['menu_id'] ?? 1);
        $menu_list = Menu::all()->pluck('name', 'id')->toArray() ?? [];

        if (!$this->config['is_admin'])
            $items = $menu->items()
                ->where(['parent' => 0])
                ->get()
                ->map(function ($item) {
                    if ($item->model_id && $item->model_type) {
                        $tmp = getModel($item->model_type)::find($item->model_id);
                        !empty($tmp) ? $item->link = $tmp->getUrl() : $item->link = url('/404');
                    }
                    return $item;
                });

        return block('vertical_menu', $this->config, ['menus' => $menu_list, 'styles' => $this->styles], ['menu' => $items ?? null]);
    }
}
