<?php

namespace App\Repositories;

use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Layout;
use App\Interfaces\Repositories\LayoutRepositoryInterface;

class LayoutRepository implements LayoutRepositoryInterface
{
    use Repository;

    protected $model;

    public function __construct()
    {
        $this->model = app(Layout::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
