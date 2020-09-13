<?php

namespace App\Widgets\Blocks;

use Arrilot\Widgets\AbstractWidget;
use App\Menu;

class HorizontalMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
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

    public function convertMenuList()
    {
        $all = Menu::all();
        $menus = [];

        foreach ($all as $menu) {
            $menus[$menu->id] = $menu->name;
        }

        return $menus;
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->config = decodeBlockConfig($this->config);

        $menu = \App\Menu::find($this->config['block']->config['menu_id'] ?? 1);

        if ($this->config['is_admin'] === false)
            $items = $menu->items()->where(['parent' => 0])->get();

        return block('horizontal_menu', $this->config, ['menus' => $this->convertMenuList()], ['menu' => $items ?? null]);
    }
}
