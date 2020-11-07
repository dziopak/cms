<?php

namespace App\View\Components\Admin\Widgets;


use Illuminate\View\Component;
use App\Entities\Post;

class RecentPosts extends Component
{

    public $posts, $config = [
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


    public function __construct($widget, $auto)
    {
        $this->config['x'] = $widget['x'];
        $this->config['y'] = $widget['y'];
        $this->config['w'] = $widget['w'];
        $this->config['h'] = $widget['h'];
        $this->config['auto'] = $auto;

        $this->posts = Post::orderByDesc('created_at')
            ->take($this->config['count'])
            ->get();
    }


    public function render()
    {
        return view('admin.widgets.recent_posts', [
            'posts' => $this->posts,
            'config' => $this->config
        ]);
    }
}
