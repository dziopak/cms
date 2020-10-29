<?php

namespace App\View\Components\Admin\Tables;

use Illuminate\View\Component;

class Table extends Component
{
    public $table, $fields;
    public $form, $endpoint;
    public $filters, $controls, $actions, $mass;
    public $table_id, $form_id;

    public function __construct($table, $fields, $filters = true, $controls = true, $actions = true, $mass = true, $form = true, $endpoint = null, $table_id = null, $form_id = null)
    {
        $this->table = $table;
        $this->fields = $fields;

        $this->form = $form;
        $this->endpoint = $endpoint;

        $this->table_id = $table_id;
        $this->form_id = $form_id;

        $this->actions = $actions;
        $this->filters = $filters;
        $this->mass = $mass;

        if (!empty($controls) && $controls !== true) {
            $this->actions = false;
            $this->filters = false;
            $this->mass = false;
        }

        if (empty($table['sort_by'])) $this->table['sort_by'] = ['name' => 'Tytuł / Nazwa'];
    }

    public function render()
    {
        return view('admin.components.tables.default');
    }
}
