<?php

namespace App\Http\Controllers\Front;

use App\Entities\Layout;
use App\Entities\PostCategory;
use App\Http\Controllers\Controller;

class PostCategoriesController extends Controller
{
    private $layout;

    public function __construct()
    {
        $this->layout = getConfig('content', 'post_category_layout');
    }

    public function show($category)
    {
        $category = PostCategory::with('posts')->findBySlugOrFail($category);
        $entries = $category->posts()->orderByDesc('created_at')->paginate(4) ?? [];

        return view('Theme::modules.categories.show', [
            'blocks' => Layout::findOrFail($this->layout)->getLayout(),
            'category' => $category,
            'entries' => $entries,
            'type' => 'posts'
        ]);
    }
}
