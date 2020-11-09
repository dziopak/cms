<?php

namespace App\Http\Controllers\Front;

use App\Entities\Layout;
use App\Entities\PageCategory;
use App\Http\Controllers\Controller;

class PageCategoriesController extends Controller
{

    private $layout;

    public function __construct()
    {
        $this->layout = getConfig('content', 'page_category_layout');
    }

    public function show($category)
    {
        $category = PageCategory::with('pages')->findBySlugOrFail($category);
        $entries = $category->pages()->orderByDesc('created_at')->paginate(10) ?? [];

        return view('Theme::modules.categories.show', [
            'blocks' => Layout::findOrFail($this->layout)->getLayout(),
            'category' => $category,
            'entries' => $entries,
            'type' => 'pages'
        ]);
    }
}
