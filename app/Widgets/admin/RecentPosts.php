<?php

namespace App\Widgets\admin;

use Arrilot\Widgets\AbstractWidget;
use App\Post;

class RecentPosts extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 5
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $posts = Post::orderByDesc('created_at')->take($this->config['count'])->get();
        return view('widgets.admin.recent_posts', [
            'config' => $this->config,
            'posts' => $posts
        ]);
    }
}
