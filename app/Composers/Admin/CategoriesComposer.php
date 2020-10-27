<?php

namespace App\Composers\Admin;

class CategoriesComposer
{

    private function index($request, $type, $view)
    {
        switch ($type) {
            case 'post_categories':
                $data = [
                    'categories' => \App\Entities\PostCategory::orderByDesc('id')->filter($request)->paginate(15),
                    'table' => getData('Admin/Modules/Categories/post_categories_index_table')
                ];
                break;

            case 'page_categories':
                $data = [
                    'categories' => \App\Entities\PageCategory::orderByDesc('id')->filter($request)->paginate(15),
                    'table' => getData('Admin/Modules/Categories/page_categories_index_table')
                ];
                break;
        }
        return $data;
    }

    private function create($request, $type, $view)
    {
        switch ($type) {
            case 'post_categories':
                $categories = array_merge([__('admin/post_categories.no_category')], \App\Entities\PostCategory::list_all());
                $data = [
                    'categories' => $categories,
                    'form' => getData('Admin/Modules/Categories/post_categories_form', ['categories' => $categories])
                ];
                break;

            case 'page_categories':
                $categories = array_merge([__('admin/page_categories.no_category')], \App\Entities\PageCategory::list_all());
                $data = [
                    'categories' => $categories,
                    'form' => getData('Admin/Modules/Categories/page_categories_form', ['categories' => $categories])
                ];
                break;
        }
        return $data;
    }

    private function edit($request, $type, $view)
    {

        switch ($type) {
            case 'post_categories':
                $categories = array_merge([__('admin/post_categories.no_category')], \App\Entities\PostCategory::list_all());
                $data = [
                    'category' => \App\Entities\PostCategory::findOrFail($view->category_id),
                    'categories' => $categories,
                    'form' => getData('Admin/Modules/Categories/post_categories_form', ['categories' => $categories])
                ];
                break;

            case 'page_categories':
                $categories = array_merge([__('admin/page_categories.no_category')], \App\Entities\PageCategory::list_all());
                $data = [
                    'category' => \App\Entities\PageCategory::findOrFail($view->category_id),
                    'categories' => $categories,
                    'form' => getData('Admin/Modules/Categories/page_categories_form', ['categories' => $categories])
                ];
                break;
        }
        return $data;
    }

    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName());

        switch ($vw[2]) {
            case 'index':
                $data = $this->index($request, $vw[1], $view);
                break;

            case 'edit':
                $data = $this->edit($request, $vw[1], $view);
                break;

            case 'create':
                $data = $this->create($request, $vw[1], $view);
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
