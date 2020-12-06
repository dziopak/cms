<?php

namespace App\Repositories;

use App\Entities\File;
use App\Interfaces\Repositories\FileRepositoryInterface;
use App\Traits\Repository;
use Spatie\QueryBuilder\AllowedFilter;

class FileRepository implements FileRepositoryInterface
{
    use Repository;

    protected $model;

    public function __construct()
    {
        $this->model = app(File::class);
        $this->filters[] = AllowedFilter::exact('id');
    }
}
