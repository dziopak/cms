<?php

namespace App\Observers;

use App\Entities\Page;
use Illuminate\Support\Facades\Session;

use App\Events\Pages\PageCreateEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Events\Pages\PageDestroyEvent;

class PageObserver
{

    public function created(Page $page)
    {
        if ($page->fire_events) {
            event(new PageCreateEvent($page, request()->file('thumbnail')));
            Session::flash('crud', __('admin/messages.pages.create.success'));
        }
    }


    public function updated(Page $page)
    {
        if ($page->fire_events) {
            event(new PageUpdateEvent($page, request()->file('thumbnail')));
            Session::flash('crud', __('admin/messages.pages.update.success'));
        }
    }


    public function deleted(Page $page)
    {
        if ($page->fire_events) {
            event(new PageDestroyEvent($page));
        }
    }
}
