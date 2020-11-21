<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

use App\Events\Layouts\LayoutDestroyEvent;
use Auth;

class LayoutActions
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
        Auth::user()->hasAccessOrRedirect('LAYOUT_DELETE');

        dispatchEvent(LayoutDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            flushCache('Layout');
        });

        return redirect()->back()->with('crud', __('admin/messages.layouts.mass.universal'));
    }

    public function name_replace()
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_EDIT');

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

        dispatchEvent(LayoutDestroyEvent::class, $this->items);

        return redirect()->back()->with('crud', __('admin/messages.layouts.universal'));
    }
}
