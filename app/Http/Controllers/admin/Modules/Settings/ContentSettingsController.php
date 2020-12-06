<?php

namespace App\Http\Controllers\Admin\Modules\Settings;

use App\Http\Controllers\Controller;
use App\Services\Admin\Settings\SettingsService;
use Illuminate\Http\Request;

class ContentSettingsController extends Controller
{

    private $service;

    public function __construct(SettingsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.settings.content');
    }

    public function store(Request $request)
    {
        return $this->service->store($request, 'content');
    }
}
