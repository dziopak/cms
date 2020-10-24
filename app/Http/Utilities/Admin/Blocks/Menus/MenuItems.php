<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

use Auth;
use App\Menu;

class MenuItems
{

    protected $menu;

    public function __construct($menu)
    {
        is_numeric($menu) ? $this->menu = Menu::findOrFail($menu) : $this->menu = $menu;
    }

    public function order($items)
    {
        foreach ($items as $key => $item) {
            if (!empty($item)) {
                $this->menu->items()->findOrFail($key)->update($item);
            }
        }

        return response()->json(['message' => __('admin/messages.blocks.menus.items.order'), 'data' => $items], 200);
    }


    public function attach($data)
    {
        if (!empty($data['id'])) {
            $item = $this->menu->items()->findOrFail($data['id'])->update([
                'label' => $data['label'],
                'link' => $data['link'],
                'class' => $data['class']
            ]);
            return response()->json(['message' => __('admin/messages.blocks.menus.items.update'), 'data' => $data], 200);
        } else {
            $item = $this->menu->items()->create([
                'label' => $data['label'],
                'link' => $data['link'],
                'parent' => $data['parent'],
                'class' => $data['class']
            ]);
            return response()->json(['message' => __('admin/messages.blocks.menus.items.attach'), 'data' => $data, 'id' => $item->id], 200);
        }
    }

    public function detach($item)
    {
        $this->menu->items()->findOrFail($item)->delete();
        return response()->json(['message' => __('admin/messages.blocks.menus.items.detach'), 'id' => $item], 200);
    }
}
