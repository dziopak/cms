<?php

namespace App\Composers\Admin\Blocks;

class SlidersComposer
{

    private function index($request, $view)
    {
        return [
            'sliders' => \App\Models\Slider::paginate(15),
            'table' => getData('Admin/blocks/sliders/sliders_index_table')
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
