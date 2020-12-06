<?php

namespace App\Http\Controllers\Admin\Modules\Categories;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Categories\CategoriesRequest;
use App\Services\Admin\Categories\CategoryActionService;
use App\Services\Admin\Categories\CategoryService;
use Illuminate\Http\Request;

class CategoriesController extends BaseAdminController
{
    public $requests = [
        'store' => CategoriesRequest::class,
        'update' => CategoriesRequest::class
    ];

    protected $massAction = CategoryActionService::class;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
