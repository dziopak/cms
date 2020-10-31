<?php

namespace App\View\Composers\Admin\Modules;

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

        $data = $this->$vw($request, $view);

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
