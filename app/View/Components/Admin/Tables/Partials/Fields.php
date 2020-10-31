<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Fields extends Component
{
    public $table, $field;

    public function __construct($table, $field, $type = "default")
    {
        $this->table = $table;
        $this->field = $field;
        $this->type = $type;
    }

    public function render()
    {
        return view('admin.components.tables.' . $this->type . '.partials.fields');
    }
}
