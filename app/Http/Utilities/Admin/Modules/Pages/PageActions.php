<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Events\Pages\PageDestroyEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Entities\MenuItem;
use App\Entities\Page;
use Auth;

class PageActions
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
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');

        dispatchEvent(PageDestroyEvent::class, $this->items, function () {
            $this->items->delete();

            flushCache([
                'MenuItem',
                'Page'
            ]);
        });

        return redirect()->back()->with('crud', __('admin/messages.pages.mass.universal'));
    }


    public function hide()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $this->items->update(['is_active' => 0]);

        dispatchEvent(PageUpdateEvent::class, $this->items, function () {
            flushCache('Page');
        });


        return redirect()->back()->with('crud', __('admin/messages.pages.mass.universal'));
    }


    public function show()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $this->items->update(['is_active' => 1]);

        dispatchEvent(PageUpdateEvent::class, $this->items, function () {
            flushCache(['Page', 'Category']);
        });

        return redirect()->back()->with('crud', __('admin/messages.pages.mass.universal'));
    }


    public function category()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $this->items->get()->map(function ($item) {
            $item->categories()->attach($this->request->get('category_id'));
        });

        dispatchEvent(PageUpdateEvent::class, $this->items, function () {
            flushCache(['Page', 'Category']);
        });

        return redirect()->back()->with('crud', __('admin/messages.pages.mass.assign_category'));
    }


    public function name_replace()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $searched = $this->request->get('name_search_string') ?? null;
        $replace = $this->request->get('name_replace_string') ?? null;
        $items = $this->items->get(['id', 'name']);

        if (empty($searched || empty($replace))) return false;

        foreach ($items as $page) {
            if (strpos($page->name, $searched) !== false) {
                $page->name = str_replace($searched, $replace, $page->name);
                $page->save();
            }
        }

        dispatchEvent(PageUpdateEvent::class, $this->items);

        return redirect()->back()->with('crud', __('admin/messages.pages.mass.title_replace_phrases'));
    }
}
