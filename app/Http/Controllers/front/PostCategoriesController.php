<?php

namespace App\Http\Controllers\Front;

use App\Entities\Layout;
use App\Entities\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoriesController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = config('global.general.theme');
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
    }

    public function show(Request $request, $category)
    {
        $category = PostCategory::with('posts')->findBySlug($category);
        if (empty($category)) return redirect(route('front.posts.index'));

        !empty($category->posts) ? $entries = $category->posts()->paginate(10) : $entries = [];
        $blocks = getLayout(Layout::findOrFail(1));

        $type = 'posts';

        return view('Theme::modules.categories.show', compact('category', 'blocks', 'entries', 'type'));
    }
}
