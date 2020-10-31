<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Action extends Component
{

    public $key;
    public $type;


    public function __construct($key, $type = "default")
    {
        $this->key = $key;
        $this->type = $type;
    }


    public function render()
    {
        return view('admin.components.tables.' . $this->type . '.partials.action');
    }
}
