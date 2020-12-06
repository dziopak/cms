<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\FileService;

class FilesController extends BaseApiController
{
    public function __construct(FileService $service)
    {
        $this->service = $service;
    }
}
