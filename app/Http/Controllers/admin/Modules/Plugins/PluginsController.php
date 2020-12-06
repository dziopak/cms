<?php

namespace App\Http\Controllers\Admin\Modules\Plugins;

use App\Http\Controllers\Controller;
use App\Services\Admin\Plugins\PluginService;

class PluginsController extends Controller
{

    private $service;

    public function __construct(PluginService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.plugins.index');
    }

    public function disable($slug)
    {
        if (!$this->service->setStatus($slug, false)) {
            return redirect()->back()->with('error', 'Couldn\'t disable selected plugin.');
        }

        return redirect()->back()->with('crud', __('admin/messages.plugins.disable.success'));
    }

    public function enable($slug)
    {
        if (!$this->service->setStatus($slug, true)) {
            return redirect()->back()->with('error', 'Couldn\'t activate selected plugin.');
        }

        $this->service->publishAssets($slug);
        return redirect()->back()->with('crud', __('admin/messages.plugins.enable.success'));
    }
}
