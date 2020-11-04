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
        $this->config['x'] = $block->x;
        $this->config['y'] = $block->y;
        $this->config['w'] = $block->width;
        $this->config['h'] = $block->height;
        $this->config['block_id'] = $block->id;
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
        $this->config['block'] = $block;
    }


    public function render()
    {
        $this->config = decodeBlockConfig($this->config);

        $menu = Menu::find($this->config['block']->config['menu_id'] ?? 1);
        $menu_list = Menu::all()->pluck('name', 'id')->toArray();

        if ($this->config['is_admin'] === false)
            $items = $menu->items()->where(['parent' => 0])->get();

        return block('horizontal_menu', $this->config, ['menus' => $menu_list ?? []], ['menu' => $items ?? null]);
    }
}
