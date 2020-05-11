<?php

namespace App\Widgets\Dashboard;

use Arrilot\Widgets\AbstractWidget;
use Carbon;
use App\Post;
use DB;

class PostsStatistics extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'days' => 14,
        'x' => '0',
        'y' => '0',
        'w' => 8,
        'h' => 5,
        'min-w' => '8',
        'min-h' => '6',
        'non-resizeable' => false,
        'id' => 'postsStatistics',
        'auto' => true,
        'header' => 'admin/widgets/posts_statistics.title',
        'icon' => 'fa fas fa-book'
    ];

    private function getData()
    {
        $start_date = \Carbon\Carbon::now()->subDays($this->config['days'] +  1);
        $end_date = \Carbon\Carbon::now();
        $period = \Carbon\CarbonPeriod::create($start_date, $end_date);

        $posts = DB::table('posts')->select(DB::raw('DATE(created_at) as date, count(*) as total'))->where('created_at', '>=', $start_date)->groupBy('date')->get()->keyBy('date');

        $dates = [];
        $values = [];
        foreach ($period as $key => $date) {
            $dates[$key] = '"' . $date->format('Y-m-d') . '"';
            $fdate = \Carbon\Carbon::parse($date)->format('Y-m-d');
            !empty($posts[$fdate]) ? $values[$key] = $posts[$fdate]->total : $values[$key] = 0;
        }

        $data['labels'] = implode(",", $dates);
        $data['values'] = implode(",", $values);

        return $data;
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $data = $this->getData();
        return view('admin.widgets.posts_statistics', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
}
