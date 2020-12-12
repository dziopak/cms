<?php

namespace App\Repositories;


use App\Interfaces\Repositories\PostRepositoryInterface;
use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\Repository;
use App\Entities\Post;
use Auth;

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


    public function create($attributes)
    {
        $attributes['user_id'] = Auth::user()->id;
        return $this->model->create($attributes);
    }
}
