<?php

namespace App\View\Composers\Admin\Modules;

class LayoutsComposer
{

    private function index($request, $view)
    {
        return [
            'table' => getData('Admin/Modules/Layouts/layouts_index_table')
        ];
    }


    private function create($request, $view)
    {
        return [
            'form' => getData('Admin/Modules/Layouts/layouts_form')
        ];
    }


    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        // Boot proper method
        if (method_exists($this, $vw)) {
            $data = $this->$vw($request, $view);
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
