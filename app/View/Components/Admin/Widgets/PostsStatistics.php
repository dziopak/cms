<?php

namespace App\View\Components\Admin\Widgets;

use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\View\Component;

class PostsStatistics extends Component
{

    public $config = [
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


    public function __construct($widget, $auto)
    {
        $this->config['x'] = $widget['x'];
        $this->config['y'] = $widget['y'];
        $this->config['w'] = $widget['w'];
        $this->config['h'] = $widget['h'];
        $this->config['auto'] = $auto;

        $this->data = $this->getData();
    }


    public function getData()
    {
        $end_date = Carbon::now();
        $start_date = Carbon::now()->subDays($this->config['days'] +  1);
        $period = CarbonPeriod::create($start_date, $end_date);

        $posts = DB::table('posts')->select(DB::raw('DATE(created_at) as date, count(*) as total'))->where('created_at', '>=', $start_date)->groupBy('date')->get()->keyBy('date');

        foreach ($period as $key => $date) {
            $dates[$key] = '"' . $date->format('Y-m-d') . '"';
            $fdate = Carbon::parse($date)->format('Y-m-d');
            !empty($posts[$fdate]) ? $values[$key] = $posts[$fdate]->total : $values[$key] = 0;
        }

        $data['labels'] = implode(",", $dates ?? []);
        $data['values'] = implode(",", $values ?? []);

        return $data;
    }


    public function render()
    {
        return view('admin.widgets.posts_statistics', [
            'data' => $this->data,
            'config' => $this->config
        ]);
    }
}
