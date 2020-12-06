<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Blocks\Carousels\CreateCarouselRequest;
use App\Http\Requests\Admin\Blocks\Carousels\UpdateCarouselRequest;
use App\Services\Admin\Carousels\CarouselItemService;
use App\Services\Admin\Carousels\CarouselService;
use Illuminate\Http\Request;

class CarouselsController extends BaseAdminController
{
    public $requests = [
        'store' => CreateCarouselRequest::class,
        'update' => UpdateCarouselRequest::class
    ];
    public function __construct(CarouselService $service)
    {
        $this->service = $service;
    }

    public function attach(Request $request, $id)
    {
        $service = CarouselItemService::build($id);
        return $service->attach($request->get('files'));
    }

    public function detach(Request $request, $id)
    {
        $service = CarouselItemService::build($id);
        return $service->detach($request->get('files'));
    }
}
