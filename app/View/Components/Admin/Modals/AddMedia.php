<?php

namespace App\View\Components\Admin\Modals;

use Illuminate\View\Component;

class AddMedia extends Component
{

    public $id, $endpoint, $single, $form;


    public function __construct($id = null, $endpoint = "", $single = false, $form = true)
    {
        $this->id = $id;
        $this->endpoint = $endpoint;
        $this->single = $single;
        $this->form = $form;
    }


    public function render()
    {
        return view('admin.components.modals.add_media');
    }
}
