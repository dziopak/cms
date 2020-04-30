<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Post;

class PostsController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = config('global.general.theme');
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
    }

    public function index()
    {
        $blocks = getLayout(\App\Layout::findOrFail(1));
        $posts = Post::orderByDesc('created_at')->orderByDesc('id')->paginate(5);

        return view($this->theme['url'] . '.modules.posts.index', compact('posts', 'blocks'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $blocks = getLayout(\App\Layout::findOrFail(1));

        return view($this->theme['url'] . '.modules.posts.show', compact('post', 'blocks'));
    }
}
