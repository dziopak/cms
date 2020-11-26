<?php

namespace App\Http\Utilities\Admin\Modules\Posts;

use App\Entities\Post;
use App\Events\Posts\PostDestroyEvent;
use App\Events\Posts\PostUpdateEvent;
use Auth;

class PostActions
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
        Auth::user()->hasAccessOrRedirect('POST_DELETE');

        dispatchEvent(PostDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            Post::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.posts.mass.universal'));
    }


    public function hide()
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');

        $this->items->update(['is_active' => 0]);
        dispatchEvent(PostUpdateEvent::class, $this->items, function () {
            Post::flushQueryCache();
        });


        return redirect()->back()->with('crud', __('admin/messages.posts.mass.universal'));
    }


    public function show()
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');

        $this->items->update(['is_active' => 1]);
        dispatchEvent(PostUpdateEvent::class, $this->items, function () {
            Post::flushQueryCache();
        });

        return redirect()->back()->with('crud', __('admin/messages.posts.mass.universal'));
    }


    public function category()
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');

        $this->items->get()->map(function ($item) {
            $item->categories()->attach($this->request->get('category_id'));
        });

        dispatchEvent(PostUpdateEvent::class, $this->items, function () {
            flushCache(['Post', 'Category']);
        });

        return redirect()->back()->with('crud', __('admin/messages.posts.mass.assign_category'));
    }



    public function name_replace()
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');

        $searched = $this->request->get('name_search_string') ?? null;
        $replace = $this->request->get('name_replace_string') ?? null;
        $items = $this->items->get(['id', 'name']);

        if (empty($searched || empty($replace))) return false;

        foreach ($items as $post) {
            if (strpos($post->name, $searched) !== false) {
                $post->name = str_replace($searched, $replace, $post->name);
                $post->save();
            }
        }

        dispatchEvent(PostUpdateEvent::class, $this->items);

        return redirect()->back()->with('crud', __('admin/messages.posts.mass.title_replace_phrases'));
    }
}
