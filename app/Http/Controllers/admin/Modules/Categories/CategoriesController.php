<?php

namespace App\Http\Controllers\Admin\Modules\Categories;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Categories\CreateCategoryRequest;
use App\Http\Requests\Admin\Modules\Categories\UpdateCategoryRequest;
use App\Services\Admin\Categories\CategoryActionService;
use App\Services\Admin\Categories\CategoryService;

class CategoriesController extends BaseAdminController
{
    public $requests = [
        'store' => CreateCategoryRequest::class,
        'update' => UpdateCategoryRequest::class
    ];

    protected $massAction = CategoryActionService::class;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
