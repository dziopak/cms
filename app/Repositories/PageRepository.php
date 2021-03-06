<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Page;
use App\Interfaces\Repositories\PageRepositoryInterface;
use Auth;

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


    public function create($attributes)
    {
        $attributes['user_id'] = Auth::user()->id;
        $this->model->create($attributes);
    }
}
