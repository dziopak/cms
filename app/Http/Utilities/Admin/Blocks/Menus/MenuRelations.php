<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

class MenuRelations
{
    public static function getModel($type)
    {
        switch ($type) {
            case 'page':
                return \App\Page::class;
                break;

            case 'post':
                return \App\Post::class;
                break;

            case 'post_category':
                return \App\PostCategory::class;
                break;

            case 'page_category':
                return \App\PageCategory::class;
                break;
        }
    }

    public static function search($data)
    {
        $res = [];

        foreach ($data['type'] as $type) {

            $model = MenuRelations::getModel($type)
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

        return response()->json(['message' => __('admin/messages.blocks.menus.items.search'), 'items' => $res], 200);
    }
}
