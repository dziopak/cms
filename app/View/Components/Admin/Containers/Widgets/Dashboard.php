<?php

namespace App\View\Components\Admin\Containers\Widgets;

use Illuminate\View\Component;

class Dashboard extends Component
{
    public $config;


    public function __construct($config)
    {
        $this->config = $config;
    }


    public function render()
    {
        return view('admin.components.containers.widgets.widget_static');
    }
}
