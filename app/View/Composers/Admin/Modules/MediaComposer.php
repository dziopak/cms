<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\File;

class MediaComposer
{

    private function index($request, $view)
    {
        return [
            'files' => File::filter($request)->paginate(15),
            'table' => getData('Admin/Modules/Media/media_index_table')
        ];
    }

    private function edit($request, $view)
    {
        return [
            'form' => getData('Admin/Modules/Media/media_edit_form'),
        ];
    }

    private function list($request, $view)
    {

        if (empty($view->files)) {
            return [
                'files' => File::filter($request)->get(),
                'table' => getData('Admin/Modules/Media/media_index_table')
            ];
        }
        return [];
    }


    private function partials($request, $view)
    {
        $partial = explode('.', $view->getName())[3];

        switch ($partial) {
            case 'list':
                return $this->list($request, $view);
                break;
        }

        return false;
    }


    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        // Boot proper method
        $data = $this->$vw($request, $view);

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
