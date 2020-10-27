<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Entities\Page;

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
        $page = Page::findBySlug('test-page');
        if (empty($page)) redirect(route('front.posts.index'));

        $blocks = getLayout(\App\Entities\Layout::findOrFail($page->layout));
        return view($this->theme['url'] . '.modules.pages.show', compact('page', 'blocks'));
    }
}
