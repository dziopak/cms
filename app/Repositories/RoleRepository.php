<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Role;
use App\Interfaces\Repositories\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    use Repository;

    protected $model;

    public function __construct()
    {
        $this->model = app(Role::class);
        $this->filters[] = AllowedFilter::exact('id');
    }

    public function create($arr)
    {
        $arr['access'] = serialize($arr['access']);
        return $this->model->create($arr);
    }
}
