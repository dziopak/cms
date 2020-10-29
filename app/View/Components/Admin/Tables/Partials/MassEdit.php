<?php

namespace App\View\Components\Admin\Tables\Partials;

use Illuminate\View\Component;

class MassEdit extends Component
{
    public $table;


    public function __construct($table)
    {
        $this->table = $table;
    }


    public function render()
    {
        return view('admin.components.tables.partials.mass');
    }
}
