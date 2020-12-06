<?php

namespace App\Services\Api;

use App\Entities\Page;
use App\Repositories\PageRepository;

class PageService extends BaseApiService
{
    protected $access = 'PAGE';
    public $model = Page::class;


    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }
}
