<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Slider;
use App\Interfaces\Repositories\SliderRepositoryInterface;

class SliderRepository implements SliderRepositoryInterface
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
        $this->model = app(Slider::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
