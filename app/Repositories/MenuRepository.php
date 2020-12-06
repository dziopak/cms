<?php

namespace App\Repositories;

use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Menu;
use App\Interfaces\Repositories\MenuRepositoryInterface;

class MenuRepository implements MenuRepositoryInterface
{
    use Repository;

    protected $model;

    public function __construct()
    {
        $this->model = app(Menu::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
