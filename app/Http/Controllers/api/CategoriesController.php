<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Admin\Modules\Categories\CreateCategoryRequest;
use App\Http\Requests\Admin\Modules\Categories\UpdateCategoryRequest;
use App\Services\Api\CategoryService;

class CategoriesController extends BaseApiController
{
    public $requests = [
        'store' => CreateCategoryRequest::class,
        'update' => UpdateCategoryRequest::class
    ];

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
