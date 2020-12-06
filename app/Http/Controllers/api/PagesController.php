<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\PageService;

class PagesController extends BaseApiController
{
    public function __construct(PageService $service)
    {
        $this->service = $service;
    }
}
