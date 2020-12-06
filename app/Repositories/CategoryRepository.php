<?php

namespace App\Repositories;

use App\Traits\Repository;
use App\Entities\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use Spatie\QueryBuilder\AllowedFilter;

class CategoryRepository implements CategoryRepositoryInterface
{
    use Repository;

    protected $model;

    public function __construct()
    {
        $this->model = app(Category::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
