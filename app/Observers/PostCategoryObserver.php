<?php

namespace App\Observers;

use App\Entities\PostCategory;
use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;
use Illuminate\Support\Facades\Session;

class PostCategoryObserver
{

    public function created(PostCategory $category)
    {
        if ($category->fire_events) {
            event(new CategoryCreateEvent($category, 'POST'));
            Session::flash('crud', __('admin/messages.categories.create.success'));
        }
    }


    public function updated(PostCategory $category)
    {
        if ($category->fire_events) {
            event(new CategoryUpdateEvent($category, 'POST'));
            Session::flash('crud', __('admin/messages.categories.update.success'));
        }
    }


    public function deleted(PostCategory $category)
    {
        $category->posts()->update(['category_id' => 0]);
        if ($category->fire_events) {
            event(new CategoryDestroyEvent($category, 'POST'));
        }
    }
}
