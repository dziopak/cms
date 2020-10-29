<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class Fields extends Component
{
    public $table, $field;

    public function __construct($table, $field)
    {
        $this->table = $table;
        $this->field = $field;
    }

    public function render()
    {
        return view('admin.components.tables.partials.fields');
    }
}
