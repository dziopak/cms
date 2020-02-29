<?php

namespace App\Widgets\admin;

use Arrilot\Widgets\AbstractWidget;
use App\Post;

class RecentPosts extends AbstractWidget
{
    protected $config = [
        'count' => 5
    ];

    public function run()
    {
        $posts = Post::orderByDesc('created_at')->take($this->config['count'])->get();
        return view('widgets.admin.recent_posts', [
            'config' => $this->config,
            'posts' => $posts
        ]);
    }
}
