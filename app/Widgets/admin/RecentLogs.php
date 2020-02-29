<?php

namespace App\Widgets\admin;

use Arrilot\Widgets\AbstractWidget;

class RecentLogs extends AbstractWidget
{
    protected $config = [
        'count' => 5
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
