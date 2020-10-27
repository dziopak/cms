<?php

namespace App\Widgets\Dashboard;

use Arrilot\Widgets\AbstractWidget;

class RecentLogs extends AbstractWidget
{
    protected $config = [
        'count' => 4,
        'x' => '0',
        'y' => '0',
        'w' => 4,
        'h' => 5,
        'min-w' => '4',
        'min-h' => '6',
        'id' => 'recentLogs',
        'auto' => true,
        'header' => "admin/widgets/recent_logs.title",
        'icon' => 'fa fas fa-cog'
    ];

    public function placeholder()
    {
        return 'Loading logs...';
    }

    public function run()
    {
        $logs = \App\Entities\Log::orderByDesc('created_at')->take($this->config['count'])->get();

        return view('admin.widgets.recent_logs', [
            'config' => $this->config,
            'logs' => $logs
        ]);
    }
}
