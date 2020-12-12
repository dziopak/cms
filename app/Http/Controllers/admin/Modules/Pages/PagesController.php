<?php

namespace App\Http\Controllers\Admin\Modules\Pages;


use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Pages\CreatePageRequest;
use App\Http\Requests\Admin\Modules\Pages\UpdatePageRequest;
use App\Services\Admin\Pages\PageService;
use App\Traits\ThumbnailController;

class PagesController extends BaseAdminController
{
    use ThumbnailController;

    public $requests = [
        'store' => CreatePageRequest::class,
        'update' => UpdatePageRequest::class
    ];

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }
}
