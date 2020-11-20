<?php

namespace App\View\Composers\Admin\Blocks;

class MenusComposer
{

    private function index($request, $view)
    {
        return [
            'table' => getData('Admin/Blocks/menus/menus_index_table')
        ];
    }

    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[3];

        switch ($vw) {
            case 'index':
                $data = $this->index($request, $view);
                break;
        }
        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
