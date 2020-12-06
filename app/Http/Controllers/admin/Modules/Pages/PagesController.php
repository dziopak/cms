<?php

namespace App\Http\Controllers\Admin\Modules\Pages;


use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Pages\PagesRequest;
use App\Services\Admin\Pages\PageService;
use App\Traits\ThumbnailController;

class PagesController extends BaseAdminController
{
    use ThumbnailController;

    public $requests = [
        'store' => PagesRequest::class,
        'update' => PagesRequest::class
    ];

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }
}
