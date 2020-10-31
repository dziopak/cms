<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Admin\PluginUtilities;
use Nwidart\Modules\Facades\Module;

class PluginsController extends Controller
{
    public function index()
    {
        return view('admin.plugins.index');
    }

    public function disable($slug)
    {
        if (!PluginUtilities::setStatus($slug, false)) {
            return redirect()->back()->with('error', 'Couldn\'t disable selected plugin.');
        }

        return redirect()->back()->with('crud', __('admin/messages.plugins.disable.success'));
    }

    public function enable($slug)
    {
        if (!PluginUtilities::setStatus($slug, true)) {
            return redirect()->back()->with('error', 'Couldn\'t activate selected plugin.');
        }

        PluginUtilities::publishAssets($slug);

        return redirect()->back()->with('crud', __('admin/messages.plugins.enable.success'));
    }
}
