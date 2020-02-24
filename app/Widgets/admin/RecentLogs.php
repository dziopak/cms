<?php

namespace App\Widgets\admin;

use Arrilot\Widgets\AbstractWidget;

class RecentLogs extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 5
    ];

    public $reloadTimeout = 10;
    
    public function placeholder()
    {
        return 'Loading logs...';
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $logs = \App\Log::orderByDesc('created_at')->take($this->config['count'])->get();
        
        return view('widgets.admin.recent_logs', [
            'config' => $this->config,
            'logs' => $logs
        ]);
    }
}
