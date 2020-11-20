<?php

namespace App\View\Components\Admin\Modals;

use Illuminate\View\Component;

class AddMedia extends Component
{

    public $id, $endpoint, $single, $form, $table, $files;


    public function __construct($id = null, $endpoint = "", $single = false, $form = true)
    {
        $this->id = $id;
        $this->endpoint = $endpoint;
        $this->single = $single;
        $this->form = $form;
        $this->table = getData('Admin/Modules/Media/media_index_table');
        $this->files = \App\Entities\File::get(['id', 'name', 'type', 'created_at', 'path']);
    }


    public function render()
    {
        return view('admin.components.modals.add_media');
    }
}
