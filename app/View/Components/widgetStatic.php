<?php

namespace App\View\Components;

use Illuminate\View\Component;

class widgetStatic extends Component
{
    public $config;


    public function __construct($config)
    {
        $this->config = $config;
    }


    public function render()
    {
        return view('admin.components.containers.widget_static');
    }
}
