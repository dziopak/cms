<?php

namespace App\View\Components\Admin\Buttons;

use Illuminate\View\Component;

class Update extends Component
{

    public $container;


    public function __construct($container = false)
    {
        $this->container = $container;
    }


    public function render()
    {
        return view('admin.components.buttons.update');
    }
}
