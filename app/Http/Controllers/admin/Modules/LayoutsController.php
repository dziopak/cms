<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Modules\Layouts\CreateLayoutRequest;
use App\Http\Requests\Admin\Modules\Layouts\UpdateLayoutRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Layout;
use App\Http\Utilities\Admin\Modules\Layouts\LayoutBlocks;

class LayoutsController extends Controller
{

    public function index(Request $request)
    {
        return Layout::webIndex($request);
    }

    public function create()
    {
        return Layout::webCreate();
    }

    public function store(CreateLayoutRequest $request)
    {
        return Layout::webStore($request);
    }

    public function edit($layout)
    {
        return Layout::findOrFail($layout)->webEdit();
    }

    public function update(UpdateLayoutRequest $request, $layout)
    {
        return Layout::findOrFail($layout)->webUpdate($request);
    }

    public function destroy($layout)
    {
        return Layout::findOrFail($layout)->webDestroy();
    }

    public function getBlock(Request $request)
    {
        return LayoutBlocks::getBlock($request);
    }

    public function mass()
    {
        return Layout::mass();
    }
}
