<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class MassEdit extends Component
{
    public $table;
    public $type;


    public function __construct($table = null, $type = "default")
    {
        $this->table = $table;
        $this->type = $type;
    }


    public function render()
    {
        return view('admin.components.tables.' . $this->type . '.partials.mass');
    }
}
