<?php

namespace App\Widgets\Dashboard;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Post;

class RecentPosts extends AbstractWidget
{
    protected $config = [
        'count' => 5,
        'x' => '0',
        'y' => '0',
        'w' => 4,
        'h' => 5,
        'min-w' => '4',
        'min-h' => '5',
        'id' => 'recentPosts',
        'auto' => true,
        'header' => 'admin/widgets/recent_posts.title',
        'icon' => 'fa fas fa-book'
    ];

    public function run()
    {
        $posts = Post::orderByDesc('created_at')->take($this->config['count'])->get();
        return view('admin.widgets.recent_posts', [
            'config' => $this->config,
            'posts' => $posts
        ]);
    }
}
