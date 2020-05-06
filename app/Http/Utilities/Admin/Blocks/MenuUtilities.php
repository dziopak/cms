<?php

namespace App\Http\Utilities\Admin\Blocks;

class MenuUtilities
{
    public static function order($id, $data)
    {
        $menu = \App\Menu::findOrFail($id);

        foreach ($data as $key => $item) {
            if (!empty($item)) {
                $menu->items()->findOrFail($key)->update($item);
            }
        }

        return response()->json(['message' => 'Successfuly ordered menu items', 'data' => $data], 200);
    }

    public static function attach($id, $data)
    {
        $menu = \App\Menu::findOrFail($id);

        $item = $menu->items()->create([
            'label' => $data['label'],
            'link' => $data['link'],
            'parent' => $data['parent']
        ]);

        return response()->json(['message' => 'Successfuly attached menu item', 'data' => $data, 'id' => $item->id], 200);
    }


    static function getModel($type)
    {
        switch ($type) {
            case 'page':
                $model = \App\Page::class;
                break;

            case 'post':
                $model = \App\Post::class;
                break;

            case 'post_category':
                $model = \App\PostCategory::class;
                break;

            case 'page_category':
                $model = \App\PageCategory::class;
                break;
        }
        return $model;
    }

    public static function search($data)
    {
        $res = [];

        foreach ($data['type'] as $type) {

            $model = MenuUtilities::getModel($type)
                ::where('name', 'LIKE', "%{$data['query']}%")
                ->orWhere('slug', 'LIKE', "%{$data['query']}%")
                ->orWhere('id', 'LIKE', "%{$data['query']}%")->take(10)->get(['id', 'name', 'slug']);

            foreach ($model as $item) {
                $res[] = [
                    'name' => $item->name,
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'type' => $type,
                    'url' => getUrl($item->slug, $type)
                ];
            }
        }

        return response()->json(['message' => 'Search performed successfully.', 'items' => $res], 200);
    }
}
