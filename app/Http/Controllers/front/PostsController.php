<?php

namespace App\Http\Controllers\Front;

use App\Helpers\ThemeHelpers;
use App\Http\Controllers\Controller;
use App\Entities\Post;
use App\Entities\Layout;

class PostsController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = ThemeHelpers::activeTheme();
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
    }

    public function index()
    {
        $blocks = getLayout(Layout::findOrFail(config('global')['general']['layout']));
        $posts = Post::orderByDesc('created_at')->orderByDesc('id')->paginate(3);

        return view('Theme::modules.posts.index', compact('posts', 'blocks'));
    }

    public function show($id)
    {
        $post = Post::with('author', 'category', 'thumbnail')
            ->where(['slug' => $id])
            ->orWhere(['id' => $id])
            ->first();

        $layout_id = config('global')['general']['post_layout'];
        $blocks = getLayout(Layout::findOrFail($layout_id));

        return view('Theme::modules.posts.show', compact('post', 'blocks'));
    }
}
