<?php

namespace App\View\Composers\Admin;

class MediaComposer
{

    private function index($request, $view)
    {
        return [
            'files' => \App\Entities\File::filter($request)->paginate(15),
            'table' => getData('Admin/Modules/Media/media_index_table')
        ];
    }

    private function edit($request, $view)
    {
        $file = \App\Entities\File::findOrFail($view->file->id);
        return [
            'form' => getData('Admin/Modules/Media/media_edit_form'),
            'file' => $file
        ];
    }

    private function list($request, $view)
    {

        if (empty($view->files)) {
            return [
                'files' => \App\Entities\File::filter($request)->get(),
                'table' => getData('Admin/Modules/Media/media_index_table')
            ];
        }
        return [];
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
                $data = $this->edit($request, $view);
                break;

            case 'partials':
                $partial = explode('.', $view->getName())[3];
                switch ($partial) {
                    case 'list':
                        $data = $this->list($request, $view);
                        break;
                }
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
