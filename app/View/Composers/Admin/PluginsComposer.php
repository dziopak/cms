<?php

namespace App\View\Composers\Admin;

use App\Http\Utilities\Admin\PluginUtilities;

class PluginsComposer
{

    private function index($request, $view)
    {
        return [
            'modules' => [
                'active' => PluginUtilities::active(),
                'inactive' => PluginUtilities::inactive()
            ],
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
