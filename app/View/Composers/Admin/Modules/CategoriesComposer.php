<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\PostCategory;
use App\Entities\PageCategory;

class CategoriesComposer
{

    private function index($request, $type, $view)
    {
        switch ($type) {
            case 'post_categories':
                $data = [
                    'categories' => PostCategory::orderByDesc('id')->filter($request)->paginate(15),
                    'table' => getData('Admin/Modules/Categories/post_categories_index_table')
                ];
                break;

            case 'page_categories':
                $data = [
                    'categories' => PageCategory::orderByDesc('id')->filter($request)->paginate(15),
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
                $categories = array_merge([__('admin/post_categories.no_category')], PostCategory::list_all());
                $data = [
                    'categories' => $categories,
                    'form' => getData('Admin/Modules/Categories/post_categories_form', ['categories' => $categories])
                ];
                break;

            case 'page_categories':
                $categories = array_merge([__('admin/page_categories.no_category')], PageCategory::list_all());
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
                $categories = array_merge([__('admin/post_categories.no_category')], PostCategory::list_all());
                $data = [
                    'categories' => $categories,
                    'form' => getData('Admin/Modules/Categories/post_categories_form', ['categories' => $categories])
                ];
                break;

            case 'page_categories':
                $categories = array_merge([__('admin/page_categories.no_category')], PageCategory::list_all());
                $data = [
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
        $action = explode('.', $view->getName())[2];
        $type = explode('.', $view->getName())[1];

        // Boot proper method
        if (method_exists($this, $action)) {
            $data = $this->$action($request, $type, $view);
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
