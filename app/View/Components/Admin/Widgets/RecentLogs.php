<?php

namespace App\View\Components\Admin\Widgets;


use Illuminate\View\Component;
use App\Entities\Log;

class RecentLogs extends Component
{

    public $logs, $config = [
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


    public function __construct($widget, $auto)
    {
        $this->config['x'] = $widget['x'];
        $this->config['y'] = $widget['y'];
        $this->config['w'] = $widget['w'];
        $this->config['h'] = $widget['h'];
        $this->config['auto'] = $auto;

        $this->logs = Log::orderByDesc('created_at')
            ->take($this->config['count'])
            ->get();
    }


    public function render()
    {
        return view('admin.widgets.recent_logs', [
            'config' => $this->config,
            'logs' => $this->logs
        ]);
    }
}
