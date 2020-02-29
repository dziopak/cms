<?php

namespace App\Widgets\admin;

use Arrilot\Widgets\AbstractWidget;

class RecentlyLoggedIn extends AbstractWidget
{
    protected $config = [
        'count' => 5
    ];
    
    public function placeholder()
    {
        return 'Loading recently logged in users...';
    }

    public function run()
    {
        $users = \App\User::with('role')->orderByDesc('last_login')->take($this->config['count'])->get();

        return view('widgets.admin.recently_logged_in', [
            'config' => $this->config,
            'users' => $users
        ]);
    }
}
