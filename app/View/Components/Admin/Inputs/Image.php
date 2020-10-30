<?php

namespace App\View\Components\Admin\Inputs;

use Illuminate\View\Component;

class Image extends Component
{

    public $item, $name;
    public $endpoint;

    public function __construct($item, $name, $endpoint)
    {
        $this->item = $item;
        $this->name = $name;
        $this->endpoint = $endpoint;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('admin.components.inputs.image');
    }
}
