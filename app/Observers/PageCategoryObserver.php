<?php

namespace App\Observers;

use App\Entities\PageCategory;
use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;
use Illuminate\Support\Facades\Session;

class PageCategoryObserver
{

    public function created(PageCategory $category)
    {
        if ($category->fire_events) {
            event(new CategoryCreateEvent($category, 'PAGE'));
            Session::flash('crud', __('admin/messages.categories.create.success'));
        }
    }


    public function updated(PageCategory $category)
    {
        if ($category->fire_events) {
            event(new CategoryUpdateEvent($category, 'PAGE'));
            Session::flash('crud', __('admin/messages.categories.update.success'));
        }
    }


    public function deleted(PageCategory $category)
    {
        $category->pages()->update(['category_id' => 0]);
        if ($category->fire_events) {
            event(new CategoryDestroyEvent($category, 'PAGE'));
        }
    }
}
