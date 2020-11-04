<?php

namespace App\View\Components\Admin\Widgets;

use Illuminate\View\Component;
use App\Entities\User;

class RecentlyLoggedIn extends Component
{

    public $users, $config = [
        'count' => 5,
        'x' => '0',
        'y' => '0',
        'w' => 4,
        'h' => 5,
        'min-w' => '4',
        'min-h' => '1',
        'id' => 'recentlyLoggedIn',
        'auto' => true,
        'header' => 'admin/widgets/recently_logged_in.title',
        'icon' => 'fa fas fa-user-circle'
    ];


    public function __construct($widget, $auto)
    {
        $this->config['x'] = $widget['x'];
        $this->config['y'] = $widget['y'];
        $this->config['w'] = $widget['w'];
        $this->config['h'] = $widget['h'];
        $this->config['auto'] = $auto;

        $this->users = User::with('role')
            ->orderByDesc('last_login')
            ->take($this->config['count'])
            ->get();
    }


    public function render()
    {
        return view('admin.widgets.recently_logged_in');
    }
}
