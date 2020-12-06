<?php

namespace App\View\Composers\Admin\Blocks;

use App\Entities\Carousel;

class CarouselsComposer
{

    private function index($request, $view)
    {
        return [
            'table' => getData('Admin/Blocks/carousels/carousels_index_table')
        ];
    }


    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        switch ($vw) {
            case 'index':
                $data = $this->index($request, $view);
                break;

            case 'edit':
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
