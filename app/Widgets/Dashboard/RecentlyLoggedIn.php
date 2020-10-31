<?php

namespace App\Widgets\Dashboard;

use Arrilot\Widgets\AbstractWidget;

class RecentlyLoggedIn extends AbstractWidget
{
    protected $config = [
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

    public function placeholder()
    {
        return 'Loading recently logged in users...';
    }

    public function run()
    {
        $users = \App\Entities\User::with('role')->orderByDesc('last_login')->take($this->config['count'])->get();

        return view('admin.widgets.recently_logged_in', [
            'config' => $this->config,
            'users' => $users
        ]);
    }
}
