<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Page;

class PagesController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = config('global.general.theme');
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $page = Page::with('author', 'category', 'thumbnail')->findOrFail($id);
        } else {
            $page = Page::with('author', 'category', 'thumbnail')->where(['slug' => $id])->orWhere(['slug_pl' => $id])->first();
        }

        if ($page) {
            $blocks = getLayout(\App\Layout::findOrFail($page->layout));
            return view($this->theme['url'] . '.modules.pages.show', compact('page', 'blocks'));
        } else {
            return redirect(route('front.posts.index'));
        }
    }
}
