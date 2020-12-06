<?php

namespace App\Services\Admin\Categories;

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
    }
}
