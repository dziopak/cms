<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Entities\Post;
use App\Entities\Layout;

class PostsController extends Controller
{

    private $listing_layout;
    private $single_layout;

    public function __construct()
    {
        $this->listing_layout = getConfig('content', 'post_listing_layout');
        $this->single_layout = getConfig('content', 'post_single_layout');
    }


    public function index()
    {
        $blocks = Layout::findOrFail($this->listing_layout)->getLayout();
        $perPage = config('global')['content']['front_posts_per_page'] ?? 5;
        $posts = Post::orderByDesc('created_at')->paginate($perPage);

        return view('Theme::modules.posts.index', compact('posts', 'blocks'));
    }


    public function show($id)
    {
        $post = Post::with('author', 'categories', 'thumbnail')
            ->where(['slug' => $id])
            ->orWhere(['id' => $id])
            ->first();

        $blocks = Layout::findOrFail($this->single_layout)->getLayout();

        return view('Theme::modules.posts.show', compact('post', 'blocks'));
    }
}
