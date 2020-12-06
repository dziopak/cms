<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Blocks\Sliders\CreateSliderRequest;
use App\Http\Requests\Admin\Blocks\Sliders\UpdateSliderRequest;
use App\Services\Admin\Sliders\SliderItemService;
use App\Services\Admin\Sliders\SliderService;
use Illuminate\Http\Request;

class SlidersController extends BaseAdminController
{
    public $requests = [
        'store' => CreateSliderRequest::class,
        'update' => UpdateSliderRequest::class
    ];

    public function __construct(SliderService $service)
    {
        $this->service = $service;
    }

    public function attach(Request $request, $id)
    {
        $service = SliderItemService::build($id);
        return $service->attach($request->get('files'));
    }
}
