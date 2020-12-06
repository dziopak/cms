<?php

namespace App\Http\Controllers\Admin\Modules\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Layouts\LayoutService;

class LayoutGetBlockController extends Controller
{
    public function __construct(LayoutService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        return $this->service->getBlock($request);
    }
}
