<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\User;
use App\Interfaces\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    use Repository;

    /**
     * The model being queried.
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        // setup the model
        $this->model = app(User::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
