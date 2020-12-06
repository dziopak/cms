<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Post;
use App\Interfaces\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
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
        $this->model = app(Post::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
