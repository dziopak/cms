<?php

namespace App\Composers\Admin\Blocks;

class MenusComposer
{

    private function index($request, $view)
    {
        return [
            'menus' => \App\Models\Menu::paginate(15),
            'table' => getData('Admin/Blocks/menus/menus_index_table')
        ];
    }

    private function edit($request, $view)
    {
        return [
            'menu' => \App\Models\Menu::with('items')->findOrFail($request->route('menu')),
            'item_types' => [
                'url' => 'URL',
                'entries' => 'Entries'
            ]
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

            case 'edit':
                $data = $this->edit($request, $view);
                break;
        }
        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
