<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\Category;
use App\Entities\Layout;

class PagesComposer
{

    private function index($request, $view)
    {
        return [
            'table' => getData('Admin/Modules/Pages/pages_index_table')
        ];
    }

    private function create($request, $view)
    {
        $categories = Category::list();
        $layouts = Layout::list();

        return [
            'categories' => $categories,
            'form' => getData('Admin/Modules/Pages/pages_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null), 'layouts' => $layouts ?? [0 => 'none']])
        ];
    }

    private function edit($request, $view)
    {
        $categories = Category::list();
        $layouts = Layout::list();

        return [
            'form' => getData(
                'Admin/Modules/Pages/pages_form',
                [
                    'categories' => $categories,
                    'thumbnail' => getThumbnail($view->page->thumbnail),
                    'layouts' => $layouts ?? [0 => 'none'],
                    'thumbnail_endpoint' => route('admin.pages.update', $view->page->id)
                ]
            ),
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
