<?php

namespace App\Repositories;

use App\Entities\Carousel;
use App\Interfaces\Repositories\CarouselRepositoryInterface;
use App\Traits\Repository;
use Spatie\QueryBuilder\AllowedFilter;

class CarouselRepository implements CarouselRepositoryInterface
{
    use Repository;

    protected $model;
    public $filters;

    public function __construct()
    {
        $this->model = app(Carousel::class);
        $this->filters = AllowedFilter::exact('id');
    }
}
