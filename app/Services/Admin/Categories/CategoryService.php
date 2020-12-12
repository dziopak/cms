<?php

namespace App\Services\Admin\Categories;

use App\Entities\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Services\Admin\BaseAdminService;

class CategoryService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'category';
    const ENTITY_PLURAL = 'categories';
    const ROUTE = 'admin.categories';

    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct($repository);
        $categories = Category::list(true, true);

        $this->queries = [
            'index' => [
                'table' => getData('Admin/Modules/Categories/categories_index_table')
            ],
            'create' => [
                'form' => getData('Admin/Modules/Categories/categories_form', compact('categories'))
            ],
            'edit' => [
                'form' => getData('Admin/Modules/Categories/categories_form', compact('categories'))
            ]
        ];
    }
}
