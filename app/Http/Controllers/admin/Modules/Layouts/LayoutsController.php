<?php

namespace App\Http\Controllers\Admin\Modules\Layouts;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Layouts\CreateLayoutRequest;
use App\Http\Requests\Admin\Modules\Layouts\UpdateLayoutRequest;
use Illuminate\Http\Request;
use App\Services\Admin\Layouts\LayoutService;

class LayoutsController extends BaseAdminController
{

    public $requests = [
        'store' => CreateLayoutRequest::class,
        'update' => UpdateLayoutRequest::class
    ];

    public function __construct(LayoutService $service)
    {
        $this->service = $service;
    }

    public function getBlock(Request $request)
    {
        return $this->service->getBlock($request);
    }
}
