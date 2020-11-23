<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Entities\Post;
use App\Entities\Layout;
use App\Entities\Page;

class HomeController extends Controller
{
    private function posts()
    {
        $layout = getConfig('content', 'homepage_post_listing_layout') ?? 1;
        $perPage = getConfig('content', 'homepage_posts_per_page') ?? 5;

        $blocks = Layout::findOrFail($layout)->getLayout();
        $posts = Post::orderByDesc('created_at')->paginate($perPage);

        return view('Theme::modules.posts.index', compact('posts', 'blocks'));
    }


    private function page()
    {
        $page = Page::findBySlug(getConfig('content', 'homepage_page_id'));
        if (empty($page)) return $this->posts();

        $blocks = $page->layout->getLayout();

        return view('Theme::modules.pages.show', compact('page', 'blocks'));
    }


    public function __invoke()
    {
        $type = getConfig('content', 'homepage_type');
        switch ($type) {
            case 'posts':
                return $this->posts();
                break;

            case 'page':
                return $this->page();
                break;
        }
    }
}
