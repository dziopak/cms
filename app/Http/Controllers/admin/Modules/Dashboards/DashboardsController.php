<?php

namespace App\Http\Controllers\Admin\Modules\Dashboards;

use App\Http\Controllers\Controller;
use App\Services\Admin\Dashboards\DashboardService;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{

    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function update(Request $request)
    {
        return $this->service->update($request);
    }
}
