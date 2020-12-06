<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Api\CategoryService;

class CategoriesController extends BaseApiController
{
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
