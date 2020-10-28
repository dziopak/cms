<?php

namespace App\View\Components;

use Illuminate\View\Component;

class block extends Component
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
        return view('admin.components.containers.block');
    }
}
