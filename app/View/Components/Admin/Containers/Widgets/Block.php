<?php

namespace App\View\Components\Admin\Containers\Widgets;

use Illuminate\View\Component;

class Block extends Component
{
    public $config;
    public $key;

    public function __construct($config, $key)
    {
        $this->config = $config;
        $this->key = $key;
    }


    public function render()
    {
        return view('admin.components.containers.widgets.block');
    }
}
