<?php

namespace App\Http\Controllers\Admin\Modules\Dashboards;

use App\Http\Controllers\Controller;
use App\Services\Admin\Dashboards\DashboardService;
use Illuminate\Http\Request;

class DashboardGetWidgetController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        return $this->service->getWidget($request);
    }
}
