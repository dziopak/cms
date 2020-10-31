<?php

namespace App\Observers;

use App\Events\Posts\PostCreateEvent;
use App\Events\Posts\PostUpdateEvent;
use App\Events\Posts\PostDestroyEvent;

use Illuminate\Support\Facades\Session;
use App\Entities\Post;

class PostObserver
{

    public function created(Post $post)
    {
        if ($post->fire_events) {
            event(new PostCreateEvent($post, request()->file('thumbnail')));
            Session::flash('crud', __('admin/messages.posts.create.success'));
        }
    }


    public function updated(Post $post)
    {
        if ($post->fire_events) {
            event(new PostUpdateEvent($post, request()->file('thumbnail')));
            Session::flash('crud', __('admin/messages.posts.update.success'));
        }
    }


    public function deleted(Post $post)
    {
        if ($post->fire_events) {
            event(new PostDestroyEvent($post));
        }
    }
}
