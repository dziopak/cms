<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Page;
use App\Interfaces\Repositories\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface
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
        $this->model = app(Page::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
