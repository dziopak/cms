<?php

namespace App\View\Components\Admin\Widgets;

use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\View\Component;

class ContentStatistics extends Component
{

    public $config = [
        'days' => 320,
        'x' => '0',
        'y' => '0',
        'w' => 4,
        'h' => 6,
        'min-w' => '4',
        'min-h' => '6',
        'non-resizeable' => false,
        'id' => 'contentStatistics',
        'auto' => true,
        'header' => 'admin/widgets/content_statistics.title',
        'icon' => 'fa fas fa-book'
    ];


    public function __construct($widget, $auto)
    {
        $this->config['x'] = $widget['x'];
        $this->config['y'] = $widget['y'];
        $this->config['w'] = $widget['w'];
        $this->config['h'] = $widget['h'];
        $this->config['auto'] = $auto;
    }


    public function render()
    {
        $start_date = Carbon::now()->subDays($this->config['days'] +  1);
        $end_date = Carbon::now();
        $period = CarbonPeriod::create($start_date, $end_date);

        $data = [];

        if ($this->config['days'] === 0) {
            $data[] = "'" . ($raw['users'] = DB::table('users')->select(DB::raw('count(*) as total'))->first()->total) . "'";
            $data[] = "'" . ($raw['pages'] = DB::table('pages')->select(DB::raw('count(*) as total'))->first()->total) . "'";
            $data[] = "'" . ($raw['posts'] = DB::table('posts')->select(DB::raw('count(*) as total'))->first()->total) . "'";
        } else {
            $data[] = "'" . ($raw['users'] = DB::table('users')->select(DB::raw('count(*) as total'))->where('created_at', '>=', $start_date)->first()->total) . "'";
            $data[] = "'" . ($raw['pages'] = DB::table('pages')->select(DB::raw('count(*) as total'))->where('created_at', '>=', $start_date)->first()->total) . "'";
            $data[] = "'" . ($raw['posts'] = DB::table('posts')->select(DB::raw('count(*) as total'))->where('created_at', '>=', $start_date)->first()->total) . "'";
        }

        $labels = ['"Users"', '"Pages"', '"Posts"'];

        return view('admin.widgets.content_statistics', [
            'config' => $this->config,
            'data' => implode(', ', $data),
            'raw' => $raw,
            'labels' => implode(', ', $labels)
        ]);
    }
}
