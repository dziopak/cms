<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\Category;

class CategoriesComposer
{

    private function index($request, $view)
    {
        return [
            'table' => getData('Admin/Modules/Categories/categories_index_table')
        ];
    }

    private function create($request, $view)
    {

        $categories = Category::list();
        $data = [
            'form' => getData('Admin/Modules/Categories/categories_form', compact('categories'))
        ];

        return $data;
    }

    private function edit($request, $view)
    {
        $categories = Category::list();
        unset($categories[$view->category->id]);

        $data = [
            'form' => getData('Admin/Modules/Categories/categories_form', compact('categories'))
        ];

        return $data;
    }

    public function compose($view)
    {
        $request = request();
        $action = explode('.', $view->getName())[2];

        // Boot proper method
        if (method_exists($this, $action)) {
            $data = $this->$action($request, $view);
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
