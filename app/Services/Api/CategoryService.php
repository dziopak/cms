<?php

namespace App\Services\Api;

use App\Entities\Category;
use App\Repositories\CategoryRepository;

class CategoryService extends BaseApiService
{
    protected $access = 'CATEGORY';
    public $model = Category::class;


    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
