<?php

namespace App\Http\Controllers\Front;

use App\Entities\Layout;
use App\Entities\PageCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageCategoriesController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = config('global.general.theme');
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
    }

    public function show(Request $request, $category)
    {
        $category = PageCategory::with('pages')->findBySlug($category);
        if (empty($category)) return redirect(route('front.posts.index'));

        !empty($category->pages) ? $entries = $category->pages()->paginate(10) : $entries = [];
        $blocks = getLayout(Layout::findOrFail(1));

        $type = 'pages';

        return view('Theme::modules.categories.show', compact('category', 'blocks', 'entries', 'type'));
    }
}
