<?php

namespace App\View\Components\Admin\Other;

use Illuminate\View\Component;

class Breadcrumb extends Component
{

    public $route;
    public $name;

    public function __construct($route = null, $name)
    {
        $this->route = $route;
        $this->name = $name;
    }


    public function render()
    {
        return view('admin.components.other.breadcrumb');
    }
}
