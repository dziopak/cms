<?php

namespace App\Widgets\admin;

use Arrilot\Widgets\AbstractWidget;

class RecentLogs extends AbstractWidget
{
    protected $config = [
        'count' => 5,
        'x' => '0',
        'y' => '0',
        'w' => 4,
        'h' => 5,
        'min-w' => '4',
        'min-h' => '6',
        'id' => 'recentLogs',
        'auto' => true
    ];

    public function placeholder()
    {
        return 'Loading logs...';
    }

    public function run()
    {
        $logs = \App\Log::orderByDesc('created_at')->take($this->config['count'])->get();
        
        return view('widgets.admin.recent_logs', [
            'config' => $this->config,
            'logs' => $logs
        ]);
    }
}
