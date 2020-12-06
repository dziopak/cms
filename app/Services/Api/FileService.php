<?php

namespace App\Services\Api;

use App\Entities\File;
use App\Repositories\FileRepository;

class FileService extends BaseApiService
{
    protected $access = 'FILE';
    public $model = File::class;


    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }
}
