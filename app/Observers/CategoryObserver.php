<?php

namespace App\Observers;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;
use Illuminate\Support\Facades\Session;

class CategoryObserver
{

    public function created($category)
    {
        if ($category->fire_events) {
            event(new CategoryCreateEvent($category));
            Session::flash('crud', __('admin/messages.categories.create.success'));
        }
    }


    public function updated($category)
    {
        if ($category->fire_events) {
            event(new CategoryUpdateEvent($category));
            Session::flash('crud', __('admin/messages.categories.update.success'));
        }
    }


    public function deleted($category)
    {
        $category->pages()->detach();
        if ($category->fire_events) {
            event(new CategoryDestroyEvent($category));
        }
    }
}
