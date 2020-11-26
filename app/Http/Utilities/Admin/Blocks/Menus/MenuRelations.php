<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

class MenuRelations
{
    static function getModel($type)
    {
        switch ($type) {
            case 'page':
                return \App\Entities\Page::class;
                break;

            case 'post':
                return \App\Entities\Post::class;
                break;

            case 'category':
                return \App\Entities\Category::class;
                break;
        }
    }

    static function search($data)
    {
        $res = [];

        $model = MenuRelations::getModel($data['type'])
            ::where('name', 'LIKE', "%{$data['query']}%")
            ->orWhere('slug', 'LIKE', "%{$data['query']}%")
            ->orWhere('id', 'LIKE', "%{$data['query']}%")->take(10)->get(['id', 'name', 'slug']);

        foreach ($model as $item) {
            $res[] = [
                'name' => $item->name,
                'id' => $item->id,
                'slug' => $item->slug,
                'type' => $data['type'],
            ];
        }

        return response()->json(['message' => __('admin/messages.blocks.menus.items.search'), 'items' => $res], 200);
    }

    static function find($data)
    {
        $entry = self::getModel($data['type'])
            ::select(['id', 'name'])
            ->find($data['id']);

        if (empty($entry)) return response()->json('Entry not found', 404);
        return response()->json($entry);
    }
}
