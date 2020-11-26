<?php

namespace App\Http\Controllers\Front;

use App\Entities\Layout;
use App\Entities\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    private $layout;

    public function __construct()
    {
        $this->layout = getConfig('content', 'page_category_layout');
    }

    public function show($category)
    {
        $category = Category::findBySlugOrFail($category);
        $posts = $category->posts()->orderByDesc('created_at')->paginate(10) ?? [];
        $pages = $category->pages()->orderByDesc('created_at')->paginate(10) ?? [];

        return view('Theme::modules.categories.show', [
            'blocks' => Layout::findOrFail($this->layout)->getLayout(),
            'category' => $category,
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }
}
