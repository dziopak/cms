<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Actions extends Component
{

    public $field;
    public $actions;
    public $type;


    public function __construct($field = null, $actions = null, $type = "default")
    {
        $this->field = $field;
        $this->actions = $actions;
        $this->type = $type;
    }


    public function render()
    {
        return view('admin.components.tables.' . $this->type . '.partials.actions');
    }
}
