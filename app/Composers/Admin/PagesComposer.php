<?php

namespace App\Composers\Admin;

class PagesComposer
{

    private function index($request, $view)
    {
        return [
            'pages' => \App\Models\Page::with('author', 'thumbnail')->orderByDesc('id')->filter($request)->paginate(15),
            'categories' => array_merge([0 => __('admin/general.no_category')], \App\Models\PageCategory::all('id', 'name')->pluck('name', 'id')->toArray()),
            'table' => getData('Admin/Modules/pages/pages_index_table')
        ];
    }

    private function create($request, $view)
    {
        $categories = array_merge(['No category'], \App\Models\PageCategory::list_all());
        $layouts = \App\Models\Layout::list();

        return [
            'categories' => $categories,
            'form' => getData('Admin/Modules/pages/pages_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null), 'layouts' => $layouts ?? [0 => 'none']])
        ];
    }

    private function edit($request, $view)
    {
        $page = \App\Models\Page::with('thumbnail')->findOrFail($view->page_id);
        $categories = array_merge(['No category'], \App\Models\PageCategory::list_all());
        $layouts = \App\Models\Layout::list();

        return [
            'form' => getData(
                'Admin/Modules/pages/pages_form',
                [
                    'categories' => $categories,
                    'thumbnail' => getThumbnail($page->thumbnail),
                    'layouts' => $layouts ?? [0 => 'none'],
                    'thumbnail_endpoint' => route('admin.pages.update', $view->page_id)
                ]
            ),
            'page' => $page
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

            case 'edit':
                $data = $this->edit($request, $view);
                break;

            case 'create':
                $data = $this->create($request, $view);
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
