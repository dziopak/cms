<?php

namespace App\Widgets\front;

use Arrilot\Widgets\AbstractWidget;
use App\Menu;
use stdClass;

class VerticalMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
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


    public function convertMenuList()
    {
        $all = Menu::all();
        $menus = [];

        foreach ($all as $menu) {
            $menus[$menu->id] = $menu->name;
        }

        return $menus;
    }


    public function run()
    {
        $this->config = decodeBlockConfig($this->config);
        $menu = \App\Menu::find($this->config['block']->config['menu_id'] ?? 1);
        return block('vertical_menu', $this->config, ['menus' => $this->convertMenuList()], ['menu' => $menu->items]);
    }
}
