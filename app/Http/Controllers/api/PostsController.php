<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\PostService;

class PostsController extends BaseApiController
{
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
