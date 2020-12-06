<?php

namespace App\View\Composers\Admin\Modules;

use App\Services\Admin\Plugins\PluginService;

class PluginsComposer
{
    private $service;

    public function __construct(PluginService $service)
    {
        $this->service = $service;
    }

    private function index($request, $view)
    {
        return [
            'modules' => [
                'active' => $this->service->active(),
                'inactive' => $this->service->inactive()
            ],
            'table' => getData('Admin/Modules/Plugins/plugins_index_table')
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
