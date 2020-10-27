<?php

namespace App\Composers\Admin;

class PluginsComposer
{

    private function index($request, $view)
    {
        \App\Entities\Module::boot();
        $modules['active'] = \App\Entities\Module::active();
        $modules['inactive'] = \App\Entities\Module::inactive();


        return [
            'modules' => $modules,
            'table' => getData('Admin/Modules/Plugins/plugins_index_table')
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
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
