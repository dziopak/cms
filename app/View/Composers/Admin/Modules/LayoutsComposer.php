<?php

namespace App\View\Composers\Admin\Modules;

class LayoutsComposer
{

    private function index($request, $view)
    {
        $table = getData('Admin/Modules/Layouts/layouts_index_table');
        return [
            'table' => $table
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
