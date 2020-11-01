<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\Page;
use App\Entities\PageCategory;
use App\Entities\Layout;

class PagesComposer
{

    private function index($request, $view)
    {
        return [
            'pages' => Page::with('author', 'thumbnail')->filter($request)->paginate(15),
            'categories' => array_merge([0 => __('admin/general.no_category')], PageCategory::all('id', 'name')->pluck('name', 'id')->toArray()),
            'table' => getData('Admin/Modules/Pages/pages_index_table')
        ];
    }

    private function create($request, $view)
    {
        $categories = array_merge(['No category'], PageCategory::list_all());
        $layouts = Layout::list();

        return [
            'categories' => $categories,
            'form' => getData('Admin/Modules/Pages/pages_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null), 'layouts' => $layouts ?? [0 => 'none']])
        ];
    }

    private function edit($request, $view)
    {
        $categories = array_merge(['No category'], PageCategory::list_all());
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
