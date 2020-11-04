<?php

namespace App\View\Components\Admin\Buttons;

use Illuminate\View\Component;

class Update extends Component
{

    public $container;
    public $id;


    public function __construct($container = false, $id = null)
    {
        $this->container = $container;
        $this->id = $id;
    }


    public function render()
    {
        return view('admin.components.buttons.update');
    }
}
