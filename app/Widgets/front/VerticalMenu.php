<?php

namespace App\Widgets\front;

use Arrilot\Widgets\AbstractWidget;
use App\Helpers\ThemeHelpers;
use App\Menu;

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
        'id' => 'vertical-menu-block',
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
        $menus = $this->convertMenuList();
        if ($this->config['is_admin']) {
            return view('admin.blocks.vertical_menu', [
                'config' => $this->config,
                'key' => randomString(15),
                'menus' => $menus
            ]);
        } else {
            return view(ThemeHelpers::getBlockPath('vertical_menu'), [
                'config' => $this->config,
                'key' => randomString(15)
            ]);
        }
    }
}
