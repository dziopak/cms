<?php

namespace App\View\Components\Admin\Buttons;

use Illuminate\View\Component;

class Create extends Component
{

    public $access, $route;

    public function __construct($route = null, $access = null)
    {
        $this->route = $route;
        $this->access = $access;
    }


    public function render()
    {
        return view('admin.components.buttons.create');
    }
}
