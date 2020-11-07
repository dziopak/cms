<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Entities\Page;
use App\Entities\Layout;

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
        $page = Page::findBySlug($id);
        if (empty($page)) redirect(route('front.posts.index'));
        $layout = $page->layout || 1;

        $blocks = getLayout(Layout::findOrFail($layout));
        return view('Theme::modules.pages.show', compact('page', 'blocks'));
    }
}
