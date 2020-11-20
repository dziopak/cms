<?php

namespace App\Http\Utilities\Admin\Modules\Categories;

use App\Events\Categories\CategoryDestroyEvent;
use Auth;

class CategoryActions
{
    protected $items;
    private $request;


    public function __construct($items, $request)
    {
        $this->items = $items;
        $this->request = $request;
    }

    public function delete()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');

        dispatchEvent(CategoryDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            flushCache([
                'PageCategory',
                'PostCategory'
            ]);
        });

        return redirect()->back()->with('crud', __('admin/messages.categories.mass.universal'));
    }


    public function category()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');

        $this->items->update(['category_id' => $this->request->get('category_id')]);
        dispatchEvent(CategoryUpdateEvent::class, $this->items, function () {
            flushCache([
                'PageCategory',
                'PostCategory'
            ]);
        });

        return redirect()->back()->with('crud', __('admin/messages.categories.mass.universal'));
    }


    public function name_replace()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');

        $searched = $this->request->get('name_search_string') ?? null;
        $replace = $this->request->get('name_replace_string') ?? null;
        $items = $this->items->get(['id', 'name']);

        if (empty($searched || empty($replace))) return false;

        foreach ($items as $category) {
            if (strpos($category->name, $searched) !== false) {
                $category->name = str_replace($searched, $replace, $category->name);
                $category->save();
            }
        }

        dispatchEvent(CategoryUpdateEvent::class, $this->items);

        return redirect()->back()->with('crud', __('admin/messages.categories.universal'));
    }
}
