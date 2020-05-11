<?php

namespace App\Widgets\Dashboard;

use Arrilot\Widgets\AbstractWidget;
use DB;
use Carbon;


class ContentStatistics extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
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
        'header' => 'Zawartość strony',
        'icon' => 'fa fas fa-book'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $start_date = \Carbon\Carbon::now()->subDays($this->config['days'] +  1);
        $end_date = \Carbon\Carbon::now();
        $period = \Carbon\CarbonPeriod::create($start_date, $end_date);

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
