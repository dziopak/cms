<?php

namespace App\Http\Controllers\Admin\Modules\Settings;

use App\Http\Controllers\Controller;
use App\Services\Admin\Settings\SettingsService;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    private $service;

    public function __construct(SettingsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.settings.general');
    }

    public function store(Request $request)
    {
        return $this->service->store($request, 'general');
    }
}
